<?php declare(strict_types = 1);

namespace SlevomatCodingStandard\Sniffs\TypeHints;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHPStan\PhpDocParser\Ast\Type\ArrayShapeNode;
use PHPStan\PhpDocParser\Ast\Type\ArrayTypeNode;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPStan\PhpDocParser\Ast\Type\ThisTypeNode;
use PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;
use SlevomatCodingStandard\Helpers\Annotation\ParameterAnnotation;
use SlevomatCodingStandard\Helpers\AnnotationHelper;
use SlevomatCodingStandard\Helpers\AnnotationTypeHelper;
use SlevomatCodingStandard\Helpers\DocCommentHelper;
use SlevomatCodingStandard\Helpers\FunctionHelper;
use SlevomatCodingStandard\Helpers\NamespaceHelper;
use SlevomatCodingStandard\Helpers\ParameterTypeHint;
use SlevomatCodingStandard\Helpers\SniffSettingsHelper;
use SlevomatCodingStandard\Helpers\SuppressHelper;
use SlevomatCodingStandard\Helpers\TokenHelper;
use SlevomatCodingStandard\Helpers\TypeHintHelper;
use function array_filter;
use function array_key_exists;
use function array_keys;
use function array_map;
use function in_array;
use function lcfirst;
use function sprintf;
use function strtolower;
use const PHP_VERSION_ID;
use const T_BITWISE_AND;
use const T_DOC_COMMENT_CLOSE_TAG;
use const T_DOC_COMMENT_STAR;
use const T_ELLIPSIS;
use const T_FUNCTION;
use const T_VARIABLE;

class ParameterTypeHintSniff implements Sniff
{

	public const CODE_MISSING_ANY_TYPE_HINT = 'MissingAnyTypeHint';

	public const CODE_MISSING_NATIVE_TYPE_HINT = 'MissingNativeTypeHint';

	public const CODE_MISSING_TRAVERSABLE_TYPE_HINT_SPECIFICATION = 'MissingTraversableTypeHintSpecification';

	public const CODE_USELESS_ANNOTATION = 'UselessAnnotation';

	private const NAME = 'SlevomatCodingStandard.TypeHints.ParameterTypeHint';

	/** @var bool */
	public $enableObjectTypeHint = PHP_VERSION_ID >= 70200;

	/** @var string[] */
	public $traversableTypeHints = [];

	/** @var array<int, string>|null */
	private $normalizedTraversableTypeHints;

	/**
	 * @return array<int, (int|string)>
	 */
	public function register(): array
	{
		return [
			T_FUNCTION,
		];
	}

	/**
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
	 * @param File $phpcsFile
	 * @param int $functionPointer
	 */
	public function process(File $phpcsFile, $functionPointer): void
	{
		if (SuppressHelper::isSniffSuppressed($phpcsFile, $functionPointer, self::NAME)) {
			return;
		}

		if (DocCommentHelper::hasInheritdocAnnotation($phpcsFile, $functionPointer)) {
			return;
		}

		$parametersTypeHints = FunctionHelper::getParametersTypeHints($phpcsFile, $functionPointer);
		$parametersAnnotations = FunctionHelper::getValidParametersAnnotations($phpcsFile, $functionPointer);

		$this->checkTypeHints($phpcsFile, $functionPointer, $parametersTypeHints, $parametersAnnotations);
		$this->checkTraversableTypeHintSpecification($phpcsFile, $functionPointer, $parametersTypeHints, $parametersAnnotations);
		$this->checkUselessAnnotations($phpcsFile, $functionPointer, $parametersTypeHints, $parametersAnnotations);
	}

	/**
	 * @param File $phpcsFile
	 * @param int $functionPointer
	 * @param (ParameterTypeHint|null)[] $parametersTypeHints
	 * @param ParameterAnnotation[] $parametersAnnotations
	 */
	private function checkTypeHints(File $phpcsFile, int $functionPointer, array $parametersTypeHints, array $parametersAnnotations): void
	{
		$parametersWithoutTypeHint = array_keys(array_filter($parametersTypeHints, static function (?ParameterTypeHint $parameterTypeHint = null): bool {
			return $parameterTypeHint === null;
		}));

		foreach ($parametersWithoutTypeHint as $parameterName) {
			if (!array_key_exists($parameterName, $parametersAnnotations)) {
				if (!SuppressHelper::isSniffSuppressed($phpcsFile, $functionPointer, self::getSniffName(self::CODE_MISSING_ANY_TYPE_HINT))) {
					$phpcsFile->addError(
						sprintf(
							'%s %s() does not have parameter type hint nor @param annotation for its parameter %s.',
							FunctionHelper::getTypeLabel($phpcsFile, $functionPointer),
							FunctionHelper::getFullyQualifiedName($phpcsFile, $functionPointer),
							$parameterName
						),
						$functionPointer,
						self::CODE_MISSING_ANY_TYPE_HINT
					);
				}

				continue;
			}

			if (SuppressHelper::isSniffSuppressed($phpcsFile, $functionPointer, self::getSniffName(self::CODE_MISSING_NATIVE_TYPE_HINT))) {
				continue;
			}

			$parameterTypeNode = $parametersAnnotations[$parameterName]->getType();

			if ($parameterTypeNode instanceof IdentifierTypeNode && strtolower($parameterTypeNode->name) === 'null') {
				continue;
			}

			$annotationContainsOneType = AnnotationTypeHelper::containsOneType($parameterTypeNode);
			if (
				!$annotationContainsOneType
				&& !AnnotationTypeHelper::containsJustTwoTypes($parameterTypeNode)
			) {
				continue;
			}

			if ($annotationContainsOneType) {
				/** @var ArrayTypeNode|ArrayShapeNode|IdentifierTypeNode|ThisTypeNode|GenericTypeNode $parameterTypeNode */
				$parameterTypeNode = $parameterTypeNode;
				$possibleParameterTypeHint = $parameterTypeNode instanceof ArrayTypeNode || $parameterTypeNode instanceof ArrayShapeNode
					? 'array'
					: AnnotationTypeHelper::getTypeHintFromOneType($parameterTypeNode);
				$nullableParameterTypeHint = false;

			} else {
				/** @var UnionTypeNode $parameterTypeNode */
				$parameterTypeNode = $parameterTypeNode;

				if (
					!AnnotationTypeHelper::containsNullType($parameterTypeNode)
					&& !AnnotationTypeHelper::containsTraversableType($parameterTypeNode, $phpcsFile, $functionPointer, $this->getTraversableTypeHints())
				) {
					continue;
				}

				if (AnnotationTypeHelper::containsNullType($parameterTypeNode)) {
					/** @var ArrayTypeNode|ArrayShapeNode|IdentifierTypeNode|ThisTypeNode|GenericTypeNode $notNullTypeHintNode */
					$notNullTypeHintNode = AnnotationTypeHelper::getTypeFromNullableType($parameterTypeNode);
					$possibleParameterTypeHint = $notNullTypeHintNode instanceof ArrayTypeNode || $notNullTypeHintNode instanceof ArrayShapeNode
						? 'array'
						: AnnotationTypeHelper::getTypeHintFromOneType($notNullTypeHintNode);
					$nullableParameterTypeHint = true;
				} else {

					$itemsSpecificationTypeHint = AnnotationTypeHelper::getItemsSpecificationTypeFromType($parameterTypeNode, $this->getTraversableTypeHints());
					if (!$itemsSpecificationTypeHint instanceof ArrayTypeNode) {
						continue;
					}

					$possibleParameterTypeHint = AnnotationTypeHelper::getTraversableTypeHintFromType($parameterTypeNode, $this->getTraversableTypeHints());
					$nullableParameterTypeHint = false;

					if (!TypeHintHelper::isTraversableType(TypeHintHelper::getFullyQualifiedTypeHint($phpcsFile, $functionPointer, $possibleParameterTypeHint), $this->getTraversableTypeHints())) {
						continue;
					}
				}
			}

			if (!TypeHintHelper::isValidTypeHint($possibleParameterTypeHint, $this->enableObjectTypeHint)) {
				continue;
			}

			$fix = $phpcsFile->addFixableError(
				sprintf(
					'%s %s() does not have native type hint for its parameter %s but it should be possible to add it based on @param annotation "%s".',
					FunctionHelper::getTypeLabel($phpcsFile, $functionPointer),
					FunctionHelper::getFullyQualifiedName($phpcsFile, $functionPointer),
					$parameterName,
					AnnotationTypeHelper::export($parameterTypeNode)
				),
				$functionPointer,
				self::CODE_MISSING_NATIVE_TYPE_HINT
			);
			if (!$fix) {
				continue;
			}

			$phpcsFile->fixer->beginChangeset();

			$parameterTypeHint = TypeHintHelper::isSimpleTypeHint($possibleParameterTypeHint)
				? TypeHintHelper::convertLongSimpleTypeHintToShort($possibleParameterTypeHint)
				: $possibleParameterTypeHint;

			$tokens = $phpcsFile->getTokens();
			/** @var int $parameterPointer */
			$parameterPointer = TokenHelper::findNextContent($phpcsFile, T_VARIABLE, $parameterName, $tokens[$functionPointer]['parenthesis_opener'], $tokens[$functionPointer]['parenthesis_closer']);

			$beforeParameterPointer = $parameterPointer;
			do {
				$previousPointer = TokenHelper::findPreviousEffective($phpcsFile, $beforeParameterPointer - 1, $tokens[$functionPointer]['parenthesis_opener'] + 1);
				if ($previousPointer === null || !in_array($tokens[$previousPointer]['code'], [T_BITWISE_AND, T_ELLIPSIS], true)) {
					break;
				}

				/** @var int $beforeParameterPointer */
				$beforeParameterPointer = $previousPointer;
			} while (true);

			$phpcsFile->fixer->addContentBefore($beforeParameterPointer, sprintf('%s%s ', ($nullableParameterTypeHint ? '?' : ''), $parameterTypeHint));

			$phpcsFile->fixer->endChangeset();
		}
	}

	/**
	 * @param File $phpcsFile
	 * @param int $functionPointer
	 * @param (ParameterTypeHint|null)[] $parametersTypeHints
	 * @param ParameterAnnotation[] $parametersAnnotations
	 */
	private function checkTraversableTypeHintSpecification(
		File $phpcsFile,
		int $functionPointer,
		array $parametersTypeHints,
		array $parametersAnnotations
	): void
	{
		if (SuppressHelper::isSniffSuppressed($phpcsFile, $functionPointer, self::getSniffName(self::CODE_MISSING_TRAVERSABLE_TYPE_HINT_SPECIFICATION))) {
			return;
		}

		foreach ($parametersTypeHints as $parameterName => $parameterTypeHint) {
			$hasTraversableTypeHint = false;
			if ($parameterTypeHint !== null && TypeHintHelper::isTraversableType(TypeHintHelper::getFullyQualifiedTypeHint($phpcsFile, $functionPointer, $parameterTypeHint->getTypeHint()), $this->getTraversableTypeHints())) {
				$hasTraversableTypeHint = true;
			} elseif (
				array_key_exists($parameterName, $parametersAnnotations)
				&& AnnotationTypeHelper::containsTraversableType($parametersAnnotations[$parameterName]->getType(), $phpcsFile, $functionPointer, $this->getTraversableTypeHints())
			) {
				$hasTraversableTypeHint = true;
			}

			if ($hasTraversableTypeHint && !array_key_exists($parameterName, $parametersAnnotations)) {
				$phpcsFile->addError(
					sprintf(
						'%s %s() does not have @param annotation for its traversable parameter %s.',
						FunctionHelper::getTypeLabel($phpcsFile, $functionPointer),
						FunctionHelper::getFullyQualifiedName($phpcsFile, $functionPointer),
						$parameterName
					),
					$functionPointer,
					self::CODE_MISSING_TRAVERSABLE_TYPE_HINT_SPECIFICATION
				);
			} elseif (array_key_exists($parameterName, $parametersAnnotations)) {
				$parameterTypeNode = $parametersAnnotations[$parameterName]->getType();

				if (
					(
						$hasTraversableTypeHint
						|| AnnotationTypeHelper::containsTraversableType($parameterTypeNode, $phpcsFile, $functionPointer, $this->getTraversableTypeHints())
					)
					&& !AnnotationTypeHelper::containsItemsSpecificationForTraversable($parameterTypeNode, $phpcsFile, $functionPointer, $this->getTraversableTypeHints())
				) {
					$phpcsFile->addError(
						sprintf(
							'@param annotation of %s %s() does not specify type hint for items of its traversable parameter %s.',
							lcfirst(FunctionHelper::getTypeLabel($phpcsFile, $functionPointer)),
							FunctionHelper::getFullyQualifiedName($phpcsFile, $functionPointer),
							$parameterName
						),
						$parametersAnnotations[$parameterName]->getStartPointer(),
						self::CODE_MISSING_TRAVERSABLE_TYPE_HINT_SPECIFICATION
					);
				}
			}
		}
	}

	/**
	 * @param File $phpcsFile
	 * @param int $functionPointer
	 * @param (ParameterTypeHint|null)[] $parametersTypeHints
	 * @param ParameterAnnotation[] $parametersAnnotations
	 */
	private function checkUselessAnnotations(
		File $phpcsFile,
		int $functionPointer,
		array $parametersTypeHints,
		array $parametersAnnotations
	): void
	{
		if (SuppressHelper::isSniffSuppressed($phpcsFile, $functionPointer, self::getSniffName(self::CODE_USELESS_ANNOTATION))) {
			return;
		}

		foreach ($parametersTypeHints as $parameterName => $parameterTypeHint) {
			if (!array_key_exists($parameterName, $parametersAnnotations)) {
				continue;
			}

			$parameterAnnotation = $parametersAnnotations[$parameterName];

			if (!AnnotationHelper::isAnnotationUseless($phpcsFile, $functionPointer, $parameterTypeHint, $parameterAnnotation, $this->getTraversableTypeHints())) {
				continue;
			}

			$fix = $phpcsFile->addFixableError(
				sprintf(
					'%s %s() has useless @param annotation for parameter %s.',
					FunctionHelper::getTypeLabel($phpcsFile, $functionPointer),
					FunctionHelper::getFullyQualifiedName($phpcsFile, $functionPointer),
					$parameterName
				),
				$parameterAnnotation->getStartPointer(),
				self::CODE_USELESS_ANNOTATION
			);
			if (!$fix) {
				continue;
			}

			/** @var int $changeStart */
			$changeStart = TokenHelper::findPrevious($phpcsFile, T_DOC_COMMENT_STAR, $parameterAnnotation->getStartPointer() - 1);
			/** @var int $changeEnd */
			$changeEnd = TokenHelper::findNext($phpcsFile, [T_DOC_COMMENT_CLOSE_TAG, T_DOC_COMMENT_STAR], $parameterAnnotation->getEndPointer() + 1) - 1;
			$phpcsFile->fixer->beginChangeset();
			for ($i = $changeStart; $i <= $changeEnd; $i++) {
				$phpcsFile->fixer->replaceToken($i, '');
			}
			$phpcsFile->fixer->endChangeset();
		}
	}

	private function getSniffName(string $sniffName): string
	{
		return sprintf('%s.%s', self::NAME, $sniffName);
	}

	/**
	 * @return array<int, string>
	 */
	private function getTraversableTypeHints(): array
	{
		if ($this->normalizedTraversableTypeHints === null) {
			$this->normalizedTraversableTypeHints = array_map(static function (string $typeHint): string {
				return NamespaceHelper::isFullyQualifiedName($typeHint) ? $typeHint : sprintf('%s%s', NamespaceHelper::NAMESPACE_SEPARATOR, $typeHint);
			}, SniffSettingsHelper::normalizeArray($this->traversableTypeHints));
		}
		return $this->normalizedTraversableTypeHints;
	}

}
