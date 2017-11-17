<?php
	App::uses('AppController', 'Controller');

	class UsersController extends AppController
	{

		public $uses = array('Account','Supporter');

		public function login()
		{
			
			$data=$this->Supporter->find('all',array('conditions'=>array(
							
							'Supporter.status LIKE' => "1",
						)));
			//pr($data); die;
			$this->set('data',$data);


			$this->layout='login';
			//$data=$this->Account->find('all');
			
			$this->set('title_for_layout', 'Đăng nhập');
        	if($this->Auth->user()) return $this->redirect($this->Auth->redirectUrl());

        	if($this->request->is('post'))
        		{
        			$nickname=$this->request->data['Account']['nickname'];
        			$pass=$this->request->data['Account']['login_password'];

        			if( ($nickname =='') && ($pass == '') )
					{
						$this->Session->setFlash('Bạn chưa nhập tên đăng nhập , vui lòng nhập tên đăng nhập!','default',array('class'=>'alert alert-danger'));
						$this->Session->setFlash('Bạn chưa nhập mật khẩu , vui lòng nhập mật khẩu!','default',array('class'=>'alert alert-danger'));
					} else if( ($nickname !='') && ($pass == '')) 
					{
						$this->Session->setFlash('Bạn chưa nhập mật khẩu , vui lòng nhập mật khẩu!','default',array('class'=>'alert alert-danger'));
					} else if( ($nickname =='') && ($pass != '') )
					{
						$this->Session->setFlash('Bạn chưa nhập tên đăng nhập , vui lòng nhập tên đăng nhập!','default',array('class'=>'alert alert-danger'));
					} else 
					{
						$user=$this->Account->find('first',array('conditions'=>array(
							'Account.nickname'=>$nickname,
							'Account.account_type LIKE' => "1",
						)));
						// pr($user);die;
						if(!empty($user))
						{
							if($this->Auth->login())
							{
								return $this->redirect('index');
							}
							else
							{
								$this->Session->setFlash('Mật khẩu không đúng, vui lòng thử lại!','default',array('class'=>'alert alert-danger'));
							}
						}else
							{
								$this->Session->setFlash('Tài khoản hoặc mật khẩu không đúng, vui lòng thử lại!','default',array('class'=>'alert alert-danger'));
							}
					}
				}
		}

		public function index()
		{
			$this->layout='ajax';
		}


	}

?>