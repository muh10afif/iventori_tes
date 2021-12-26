<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
    }

    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('item/index');
        $this->load->view('template/footer');
    }

    public function show()
    {
        $result = [];
        $query=  $this->item->showAll();
        if($query){
            $result['items']  = $query;
        }

        echo json_encode($result);
    }

    public function addItem(){
		$config = array(
            array('field' => 'nama_item',
                'label' => 'Nama Item',
                'rules' => 'trim|required'
                ),
            // array('field' => 'unit',
            // 'label' => 'Unit',
            // 'rules' => 'required'
            // ),
            array('field' => 'stok',
            'label' => 'Stok',
            'rules' => 'required'
            ),
            array('field' => 'harga_satuan',
            'label' => 'Harga Satuan',
            'rules' => 'required'
            ),
            // array('field' => 'barang',
            // 'label' => 'Barang',
            // 'rules' => 'required'
            // )
        );
        
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'nama_item'=>form_error('nama_item'),
                // 'unit'=>form_error('unit'),
                'stok'=>form_error('stok'),
                'harga_satuan'=>form_error('harga_satuan'),
                // 'barang'=>form_error('barang'),
            );
            
        }else{
                $data = array(
                'nama_item'=> $this->input->post('nama_item'),
                'unit'=> $this->input->post('unit'),
                'stok'=> $this->input->post('stok'),
                'harga_satuan'=> $this->input->post('harga_satuan')
                
            );

            $config2['upload_path'] = './assets/upload/';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg';
            $config2['max_size'] = 2000;
            $config2['max_width'] = 2500;
            $config2['max_height'] = 1400;

            $this->load->library('upload', $config2);
            if ($this->upload->do_upload('file')) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                // $data['img_src'] = $file_name;
//                $this->resizeImage($file_name);
                // process resize image before upload
                $config3['image_library'] = 'gd2';
                $config3['source_image'] = $upload_data['full_path'];
                $config3['create_thumb'] = TRUE;
                $config3['maintain_ratio'] = TRUE;
                $config3['width'] = 75;
                $config3['height'] = 75;

                $this->image_lib->initialize($config3);

                $this->image_lib->resize();
                // $fileName = substr($upload_data['file_name'], 0, -4);
                $data['barang'] = $file_name;
            }

            if($this->item->addItem($data)){
               $result['error'] = false;
                $result['msg'] ='Item added successfully';
            }
            
        }
        echo json_encode($result);
    }

    public function UpdateItem(){
		$config = array(
            array('field' => 'nama_item',
                'label' => 'Nama Item',
                'rules' => 'trim|required'
                ),
            // array('field' => 'unit',
            // 'label' => 'Unit',
            // 'rules' => 'required'
            // ),
            array('field' => 'stok',
            'label' => 'Stok',
            'rules' => 'required'
            ),
            array('field' => 'harga_satuan',
            'label' => 'Harga Satuan',
            'rules' => 'required'
            ),
            // array('field' => 'barang',
            // 'label' => 'Barang',
            // 'rules' => 'required'
            // )
        );

        $result = [];
        
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'nama_item'=>form_error('nama_item'),
                // 'unit'=>form_error('unit'),
                'stok'=>form_error('stok'),
                'harga_satuan'=>form_error('harga_satuan'),
                // 'barang'=>form_error('barang'),
            );
            
        }else{
                $data = array(
                'nama_item'=> $this->input->post('nama_item'),
                'unit'=> $this->input->post('unit'),
                'stok'=> $this->input->post('stok'),
                'harga_satuan'=> $this->input->post('harga_satuan')
                
            );

            $config2['upload_path'] = './assets/upload/';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg';
            $config2['max_size'] = 2000;
            $config2['max_width'] = 2500;
            $config2['max_height'] = 1400;

            $this->load->library('upload', $config2);
            if ($this->upload->do_upload('file')) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                // $data['img_src'] = $file_name;
//                $this->resizeImage($file_name);
                // process resize image before upload
                $config3['image_library'] = 'gd2';
                $config3['source_image'] = $upload_data['full_path'];
                // $config3['create_thumb'] = TRUE;
                $config3['maintain_ratio'] = TRUE;
                // $config3['width'] = 75;
                // $config3['height'] = 75;

                $this->image_lib->initialize($config3);

                $this->image_lib->resize();
                // $fileName = substr($upload_data['file_name'], 0, -4);
                $data['barang'] = $file_name;
            }

            $id = $this->input->post('id_item');
            
            

            if($this->item->updateItem($id, $data)){
               $result['error'] = false;
                $result['success'] ='Item updated successfully';
            }
            
        }
        echo json_encode($result);
    }

    public function deleteItem(){
        $id = $this->input->post('id_item');
        $brg = $this->input->post('barang');
       if($this->item->deleteItem($id)){

            $path = base_url()."/assets/upload/".$brg;
            unlink($path); 
           
            $msg['error'] = false;
           $msg['success'] = 'User deleted successfully';
       }else{
            $msg['error'] = true;
       }
       echo json_encode($msg);
        
   }

}

/* End of file Item.php */
