<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AvariasPcs Controller
 *
 * @property \App\Model\Table\AvariasPcsTable $AvariasPcs
 *
 * @method \App\Model\Entity\AvariasPc[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AvariasPcsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Pcs', 'Avarias'],
        ];
        $avariasPcs = $this->paginate($this->AvariasPcs);

        $this->set(compact('avariasPcs'));
    }

    /**
     * View method
     *
     * @param string|null $id Avarias Pc id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $avariasPc = $this->AvariasPcs->get($id, [
            'contain' => ['Pcs', 'Avarias'],
        ]);

        $this->set('avariasPc', $avariasPc);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $avariasPc = $this->AvariasPcs->newEmptyEntity();
        if ($this->request->is('post')) {
            $avariasPc = $this->AvariasPcs->patchEntity($avariasPc, $this->request->getData());
            if ($this->AvariasPcs->save($avariasPc)) {
                $this->Flash->success(__('The avarias pc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The avarias pc could not be saved. Please, try again.'));
        }
        $pcs = $this->AvariasPcs->Pcs->find('list', ['limit' => 200]);
        $avarias = $this->AvariasPcs->Avarias->find('list', ['limit' => 200]);
        $this->set(compact('avariasPc', 'pcs', 'avarias'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Avarias Pc id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $avariasPc = $this->AvariasPcs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $avariasPc = $this->AvariasPcs->patchEntity($avariasPc, $this->request->getData());
            if ($this->AvariasPcs->save($avariasPc)) {
                $this->Flash->success(__('The avarias pc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The avarias pc could not be saved. Please, try again.'));
        }
        $pcs = $this->AvariasPcs->Pcs->find('list', ['limit' => 200]);
        $avarias = $this->AvariasPcs->Avarias->find('list', ['limit' => 200]);
        $this->set(compact('avariasPc', 'pcs', 'avarias'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Avarias Pc id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $avariasPc = $this->AvariasPcs->get($id);
        if ($this->AvariasPcs->delete($avariasPc)) {
            $this->Flash->success(__('The avarias pc has been deleted.'));
        } else {
            $this->Flash->error(__('The avarias pc could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
