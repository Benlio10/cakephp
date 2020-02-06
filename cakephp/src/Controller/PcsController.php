<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Pcs Controller
 *
 * @property \App\Model\Table\PcsTable $Pcs
 *
 * @method \App\Model\Entity\Pc[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PcsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $pcs = $this->paginate($this->Pcs);

        $this->set(compact('pcs'));
    }

    /**
     * View method
     *
     * @param string|null $id Pc id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pc = $this->Pcs->get($id, [
            'contain' => ['Avarias'],
        ]);

        $this->set('pc', $pc);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pc = $this->Pcs->newEmptyEntity();
        if ($this->request->is('post')) {
            $pc = $this->Pcs->patchEntity($pc, $this->request->getData());
            if ($this->Pcs->save($pc)) {
                $this->Flash->success(__('The pc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pc could not be saved. Please, try again.'));
        }
        $avarias = $this->Pcs->Avarias->find('list', ['limit' => 200]);
        $this->set(compact('pc', 'avarias'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pc id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pc = $this->Pcs->get($id, [
            'contain' => ['Avarias'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pc = $this->Pcs->patchEntity($pc, $this->request->getData());
            if ($this->Pcs->save($pc)) {
                $this->Flash->success(__('The pc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pc could not be saved. Please, try again.'));
        }
        $avarias = $this->Pcs->Avarias->find('list', ['limit' => 200]);
        $this->set(compact('pc', 'avarias'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pc id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pc = $this->Pcs->get($id);
        if ($this->Pcs->delete($pc)) {
            $this->Flash->success(__('The pc has been deleted.'));
        } else {
            $this->Flash->error(__('The pc could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
