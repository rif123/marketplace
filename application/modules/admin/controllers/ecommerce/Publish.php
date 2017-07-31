<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Publish extends ADMIN_Controller
{
    private $title = 'Product';
    public function index($id = 0)
    {
        $this->login_check();
        $is_update = false;
        $trans_load = null;
        if ($id > 0 && $_POST == null) {
            $trans_load = $this->AdminModel->getProductOne($id);
        }

        if (isset($_POST['submit'])) {

            if ($id > 0) {
                $is_update = true;
            }
            unset($_POST['submit']);
            $config['upload_path'] = './attachments/shop_images/';
            $config['allowed_types'] = $this->allowed_img_types;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('userfile')) {
                log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
            }
            $img = $this->upload->data();
            if ($img['file_name'] != null) {
                $_POST['image'] = $img['file_name'];
            }
            if (isset($_GET['to_lang'])) {
                $id = 0;
            }

            if ($is_update) {
                $result = $this->AdminModel->updateProduct($_POST, $id);
                $this->AdminModel->updateUploadProd($_POST, $id);
                if ( $result ==1 ) {
                    $this->session->set_flashdata('result_add', $this->title.' is added!');
                    $this->saveHistory('Create City  - ' . $_POST['name']);
                } else {
                    $this->session->set_flashdata('result_fail', 'Problem with '. $this->title.' add!');
                    $this->saveHistory('Cant add '.$this->title);

                }
                redirect('admin/publish');
            } else {
                $result = $this->AdminModel->saveProduct($_POST);
                $this->AdminModel->saveUploadProd($_POST, $result);
                $this->session->set_flashdata('result_add',$this->title. ' is added!');
                $this->saveHistory('Create City  - ' . $_POST['name']);
                  redirect('admin/publish');
            }
        }
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Publish Product';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['id'] = $id;
        $data['trans_load'] = $trans_load;
        $data['languages'] = $this->AdminModel->getLanguages();
        $data['shop_categories'] = $this->AdminModel->getCategoryWarung();
        $data['brands'] = $this->AdminModel->getBrands();
        $data['otherImgs'] = $this->AdminModel->getImageProd($id);
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/publish', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to publish product');
    }

    /*
     * called from ajax
     */

    public function do_upload_others_images()
    {
        if ($this->input->is_ajax_request()) {
            $upath = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR;
            if (!file_exists($upath)) {
                mkdir($upath, 0777);
            }
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = count($_FILES['others']['name']);

            for ($i = 0; $i < $cpt; $i++) {
                unset($_FILES);
                $_FILES['others']['name'] = $files['others']['name'][$i];
                $_FILES['others']['type'] = $files['others']['type'][$i];
                $_FILES['others']['tmp_name'] = $files['others']['tmp_name'][$i];
                $_FILES['others']['error'] = $files['others']['error'][$i];
                $_FILES['others']['size'] = $files['others']['size'][$i];
                $this->upload->initialize(array(
                    'upload_path' => $upath,
                    'allowed_types' => $this->allowed_img_types
                ));

                $result = $this->upload->do_upload('others');
                $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                $file_name = $upload_data['file_name'];
                $response = [
                        'filename' => $file_name,
                        'htmlfile' => "<input type='hidden' name='otherImages[]' value='".$file_name."' />"
                    ];
            }
            echo json_encode($response);
        }
    }

    public function loadOthersImages()
    {
        $output = '';
        if (isset($_POST['filename']) && $_POST['filename'] != null) {
            $dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR;
            $i=1;
            $file = $_POST['filename'];
            $output .= '
                <div class="other-img" id="image-container-' . $i . '">
                    <img src="' . base_url($dir . $_POST['filename']) . '" style="width:100px; height: 100px;">
                    <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\',' . $i . ')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>
               ';
        }
        $response['html'] = $output;
        echo json_encode($response);
    }

    /*
     * called from ajax
     */

    public function removeSecondaryImage()
    {
        if ($this->input->is_ajax_request()) {
            $img = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . ''. $_POST['image'];
            $this->db->where('name_image_prod', $_POST['image']);
            $this->db->delete('dk_image_prod');
            if (file_exists($img)){
                unlink($img);
            }
        }
    }

    /*
     * called from ajax
     */

    public function convertCurrency()
    {
        if ($this->input->is_ajax_request()) {
            $amount = $_POST['sum'];
            if ($amount == null) {
                echo 'Please type a price';
                exit;
            }
            $from = $_POST['from'];
            $to = $_POST['to'];
            $url = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
            $data = file_get_contents($url);
            preg_match("/<span class=bld>(.*)<\/span>/", $data, $converted);
            $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
            $this->saveHistory('Convert currency from ' . $from . ' to ' . $to . ' with amount  ' . $amount);
            echo round($converted, 2);
        }
    }

}
