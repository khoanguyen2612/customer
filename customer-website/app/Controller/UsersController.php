<?php
	App::uses('AppController', 'Controller');

	class UsersController extends AppController
	{

		public $uses = array('Account','Supporter','Organization');

		public function login()
		{
			
			$data=$this->Supporter->find('all',array('conditions'=>array(
							
							'Supporter.status LIKE' => "1",
						)));
			//pr($data); die;
			$this->set('data',$data);
			$this->layout='login';	
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
								return $this->redirect('../home/index');
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
		public function logout(){
			$this->redirect($this->Auth->logout());
		}

		public function index()
		{
			$this->layout='ajax';
		}

		public function update_group(){

			$user=$this->Account->find('first', array('conditions' => ['Account.id'=>$this->Auth->user('id')], ));
			// pr($user);die;			
			$this->set('user',$user);
			if($this->request->is('post')){
				$this->Account->create();

				if(!empty($this->request->data['Account']['avatar']['name'])){
					$Image=$this->request->data['Account']['avatar']['name'];
					$Image=sha1($this->request->data['Account']['avatar']['name'].rand(0,100)).'-'.$Image;
					$filename = WWW_ROOT. 'uploads/images'.DS.$Image; 
					$tmp_name=$this->request->data['Account']['avatar']['tmp_name'];
					$this->request->data['Account']['avatar']=$Image;
				}
				else{
					unset($this->request->data['Account']['avatar']);
				}

				$this->request->data['Account']['id']=$user['Account']['id'];
				$this->request->data['Account']['status']=1;

				$this->request->data['Organization']['id']=$user['Organization']['id'];
				$this->request->data['Organization']['organ_name']=$this->request->data['Account']['organ_name'];
				if(isset($this->request->data['Account']['tax_code'])){$this->request->data['Organization']['tax_code']=$this->request->data['Account']['tax_code'];}
				if(isset($this->request->data['Account']['phonenumber2'])){$this->request->data['Organization']['phonenumber2']=$this->request->data['Account']['phonenumber2'];}
				if($this->request->data['Account']['email']==$user['Account']['email']){unset($this->request->data['Account']['email']);}
				// pr($this->request->data);die;
					$this->Account->set($this->request->data['Account']);
					$this->Organization->set($this->request->data['Organization']);

				if ($this->Account->validates()){
					$this->Account->save($this->request->data);
					$this->Organization->save($this->request->data);
					if(isset($filename)){
						move_uploaded_file($tmp_name,$filename);
					}
					$this->Session->setFlash('Thông tin Tài khoản của bạn đã được thay đổi','default',array('class'=>'alert alert-success text-center'));
		            $this->redirect(array('controller'=>'Users','action'=>'update_group'));
				}

			}
			$this->render('updateprofile_oganization');

		}
		public function update_person(){
			$user=$this->Account->find('first', array('conditions' => ['Account.id'=>$this->Auth->user('id')], ));
			$this->set('user',$user['Account']);
			if($this->request->is('post')){
				$this->Account->create();
				// pr($this->request->data);die;

				if(!empty($this->request->data['Account']['avatar']['name'])){
					$Image=$this->request->data['Account']['avatar']['name'];
					$Image=sha1($this->request->data['Account']['avatar']['name'].rand(0,100)).'-'.$Image;
					$filename = WWW_ROOT. 'uploads/images'.DS.$Image; 
					$tmp_name=$this->request->data['Account']['avatar']['tmp_name'];
					$this->request->data['Account']['avatar']=$Image;
				}
				else{
					unset($this->request->data['Account']['avatar']);
				}
				$this->request->data['Account']['id']=$user['Account']['id'];
				$this->request->data['Account']['status']=1;

				unset($this->request->data['Account']['nickname']);
				if($this->request->data['Account']['email']==$user['Account']['email']){unset($this->request->data['Account']['email']);}

				if($this->Account->save($this->request->data)){
					if(isset($filename)){
	          			move_uploaded_file($tmp_name,$filename);
	          		}
					$this->Session->setFlash('Thông tin Tài khoản của bạn đã được thay đổi','default',array('class'=>'alert alert-success text-center'));
		            $this->redirect(array('controller'=>'Users','action'=>'update_person'));
				}

			}
			$this->render('updateprofile_personal');

		}
	


	}

?>