<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Avarias Controller
 *
 * @property \App\Model\Table\AvariasTable $Avarias
 *
 * @method \App\Model\Entity\Avaria[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AvariasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $avarias = $this->paginate($this->Avarias);

        $this->set(compact('avarias'));
    }

    /**
     * View method
     *
     * @param string|null $id Avaria id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $avaria = $this->Avarias->get($id, [
            'contain' => ['Pcs'],
        ]);

        $this->set('avaria', $avaria);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $avaria = $this->Avarias->newEmptyEntity();
        if ($this->request->is('post')) {
            $avaria = $this->Avarias->patchEntity($avaria, $this->request->getData());
            if ($this->Avarias->save($avaria)) {
                $this->Flash->success(__('The avaria has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The avaria could not be saved. Please, try again.'));
        }
        $pcs = $this->Avarias->Pcs->find('list', ['limit' => 200]);
        $this->set(compact('avaria', 'pcs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Avaria id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $avaria = $this->Avarias->get($id, [
            'contain' => ['Pcs'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $avaria = $this->Avarias->patchEntity($avaria, $this->request->getData());
            if ($this->Avarias->save($avaria)) {
                $this->Flash->success(__('The avaria has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The avaria could not be saved. Please, try again.'));
        }
        $pcs = $this->Avarias->Pcs->find('list', ['limit' => 200]);
        $this->set(compact('avaria', 'pcs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Avaria id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $avaria = $this->Avarias->get($id);
        if ($this->Avarias->delete($avaria)) {
            $this->Flash->success(__('The avaria has been deleted.'));
        } else {
            $this->Flash->error(__('The avaria could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
