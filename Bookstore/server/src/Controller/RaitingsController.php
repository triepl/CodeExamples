<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Raitings Controller
 *
 * @property \App\Model\Table\RaitingsTable $Raitings
 */
class RaitingsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view','isbn']);
    }



    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Books']
        ];
        $raitings = $this->paginate($this->Raitings);

        $this->set(compact('raitings'));
        $this->set('_serialize', ['raitings']);
    }

    /**
     * View method
     *
     * @param string|null $id Raiting id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $raiting = $this->Raitings->get($id, [
            'contain' => ['Users', 'Books']
        ]);

        $this->set('raiting', $raiting);
        $this->set('_serialize', ['raiting']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $raiting = $this->Raitings->newEntity();
        if ($this->request->is('post')) {
            $raiting = $this->Raitings->patchEntity($raiting, $this->request->getData());
            if ($this->Raitings->save($raiting)) {
                $this->Flash->success(__('The raiting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The raiting could not be saved. Please, try again.'));
        }
        $users = $this->Raitings->Users->find('list', ['limit' => 200]);
        $books = $this->Raitings->Books->find('list', ['limit' => 200]);
        $this->set(compact('raiting', 'users', 'books'));
        $this->set('_serialize', ['raiting']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Raiting id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $raiting = $this->Raitings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $raiting = $this->Raitings->patchEntity($raiting, $this->request->getData());
            if ($this->Raitings->save($raiting)) {
                $this->Flash->success(__('The raiting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The raiting could not be saved. Please, try again.'));
        }
        $users = $this->Raitings->Users->find('list', ['limit' => 200]);
        $books = $this->Raitings->Books->find('list', ['limit' => 200]);
        $this->set(compact('raiting', 'users', 'books'));
        $this->set('_serialize', ['raiting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Raiting id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $raiting = $this->Raitings->get($id);
        if ($this->Raitings->delete($raiting)) {
            $this->Flash->success(__('The raiting has been deleted.'));
        } else {
            $this->Flash->error(__('The raiting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function isbn()
    {
        $isbn = $this->request->params['pass'];
        //debug($isbn[0]);
        //error_log($isbn.' ',3,"log.txt");

        $raitings = $this->Raitings->find('all')
            // ->where(['isbn' => $isbn[0]])
            ->where(['isbn LIKE' => $isbn[0] . '%'])
            ->contain(['Users', 'Books']);
        // ->first();

        $this->set('raitings', $raitings);
        $this->set('_serialize', ['raitings']);
    }


}
