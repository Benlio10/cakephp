<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RegistoAvarias Controller
 *
 * @property \App\Model\Table\RegistoAvariasTable $RegistoAvarias
 *
 * @method \App\Model\Entity\RegistoAvaria[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistoAvariasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $registoAvarias = $this->paginate($this->RegistoAvarias);

        $this->set(compact('registoAvarias'));
    }

    /**
     * View method
     *
     * @param string|null $id Registo Avaria id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registoAvaria = $this->RegistoAvarias->get($id, [
            'contain' => [],
        ]);

        $this->set('registoAvaria', $registoAvaria);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registoAvaria = $this->RegistoAvarias->newEmptyEntity();
        if ($this->request->is('post')) {
            $registoAvaria = $this->RegistoAvarias->patchEntity($registoAvaria, $this->request->getData());
            if ($this->RegistoAvarias->save($registoAvaria)) {
                $this->Flash->success(__('The registo avaria has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registo avaria could not be saved. Please, try again.'));
        }
        $this->set(compact('registoAvaria'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Registo Avaria id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registoAvaria = $this->RegistoAvarias->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registoAvaria = $this->RegistoAvarias->patchEntity($registoAvaria, $this->request->getData());
            if ($this->RegistoAvarias->save($registoAvaria)) {
                $this->Flash->success(__('The registo avaria has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registo avaria could not be saved. Please, try again.'));
        }
        $this->set(compact('registoAvaria'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Registo Avaria id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registoAvaria = $this->RegistoAvarias->get($id);
        if ($this->RegistoAvarias->delete($registoAvaria)) {
            $this->Flash->success(__('The registo avaria has been deleted.'));
        } else {
            $this->Flash->error(__('The registo avaria could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
