<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class UploadComponent extends Component
{
    public $max_files = 3;

    public function upload($data = null)
    {
        if (!empty($data)) {
            if ( count( $data ) > $this->max_files ) {
                throw new NotFoundException("Error Processing Request, Max number files accepted is { $this->max_files }", 1);
            }

            foreach ($data as $file) {
                $filename = $file['name'];
                $file_tmp_name = $file['tmp_name'];
                $dir = WWW_ROOT.'img'.DS.'uploads';
                $allowed = array('png', 'jpg', 'jpeg', 'bmp');
                if ( !in_array( substr( strrchr($filename, '.'), 1 ), $allowed ) ) {
                    throw new NotFoundException("Error Processing Request", 1);
                } elseif (is_uploaded_file($file_tmp_name)) {
                    $filename = Text::uuid().'-'.$filename;

                    $filedb = TableRegistry::get('arquivos');
                    $entity = $filedb->newEntity();
                    $entity->filename = $filename;
                    $filedb->save($entity);

                    move_uploaded_file($file_tmp_name.DS.$filename);
                }
            }
        }
    }
}
