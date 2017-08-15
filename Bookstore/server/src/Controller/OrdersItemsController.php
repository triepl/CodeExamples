<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * OrdersItems Controller
 *
 * @property \App\Model\Table\OrdersItemsTable $OrdersItems
 */
class OrdersItemsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Orders', 'Books']
        ];
        $ordersItems = $this->paginate($this->OrdersItems);

        $this->set(compact('ordersItems'));
        $this->set('_serialize', ['ordersItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Orders Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ordersItem = $this->OrdersItems->get($id, [
            'contain' => ['Orders', 'Books']
        ]);

        $this->set('ordersItem', $ordersItem);
        $this->set('_serialize', ['ordersItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ordersItem = $this->OrdersItems->newEntity();
        if ($this->request->is('post')) {
            $ordersItem = $this->OrdersItems->patchEntity($ordersItem, $this->request->getData());
            if ($this->OrdersItems->save($ordersItem)) {
                $this->Flash->success(__('The orders item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The orders item could not be saved. Please, try again.'));
        }
        $orders = $this->OrdersItems->Orders->find('list', ['limit' => 200]);
        $books = $this->OrdersItems->Books->find('list', ['limit' => 200]);
        $this->set(compact('ordersItem', 'orders', 'books'));
        $this->set('_serialize', ['ordersItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Orders Item id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ordersItem = $this->OrdersItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ordersItem = $this->OrdersItems->patchEntity($ordersItem, $this->request->getData());
            if ($this->OrdersItems->save($ordersItem)) {
                $this->Flash->success(__('The orders item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The orders item could not be saved. Please, try again.'));
        }
        $orders = $this->OrdersItems->Orders->find('list', ['limit' => 200]);
        $books = $this->OrdersItems->Books->find('list', ['limit' => 200]);
        $this->set(compact('ordersItem', 'orders', 'books'));
        $this->set('_serialize', ['ordersItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Orders Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ordersItem = $this->OrdersItems->get($id);
        if ($this->OrdersItems->delete($ordersItem)) {
            $this->Flash->success(__('The orders item has been deleted.'));
        } else {
            $this->Flash->error(__('The orders item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function orderid()
    {
        $id = $this->request->params['pass'];

        $items = $this->OrdersItems->find('all')
            ->where(['order_id ' => $id[0]])
            ->contain(['Orders', 'Books']);


        $this->set('items', $items);
        $this->set('_serialize', ['items']);
    }

    
}
