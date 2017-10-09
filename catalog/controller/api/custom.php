<?php
// catalog/controller/api/custom.php added by anubhav
class ControllerApiCustom extends Controller {
  public function products() {

    $this->load->language('api/custom');
    $json = array();

    if (!isset($this->session->data['api_id'])) {
      $json['error']['warning'] = $this->language->get('error_permission');
    } else {
      // load model
      $this->load->model('catalog/product');
 
      // get products
      $products = $this->model_catalog_product->getProducts();
      $json['success']['products'] = $products;
    }
     
    if (isset($this->request->server['HTTP_ORIGIN'])) {
      $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
      $this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      $this->response->addHeader('Access-Control-Max-Age: 1000');
      $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }
 
    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function productsbycategory() {

    $this->load->language('api/custom');
    $json = array();

      if (isset($this->request->post['category_id'])) {
        $category_id = $this->request->post['category_id'];
      } else {
        $category_id = '';
      }      

      $filter_data = array(
        'filter_category_id' => $category_id,
      );

      // load model
      $this->load->model('catalog/category');
      $this->load->model('catalog/product');
      $this->load->model('tool/image');

      $results = $this->model_catalog_product->getProducts($filter_data);
      

      $data['products'] = array();

      foreach ($results as $result) {

        if ($result['image']) {
          $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
        } else {
          $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
        }

        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
          $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
        } else {
          $price = false;
        }

        if ((float)$result['special']) {
          $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
        } else {
          $special = false;
        }

        if ($this->config->get('config_tax')) {
          $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
        } else {
          $tax = false;
        }

        if ($this->config->get('config_review_status')) {
          $rating = (int)$result['rating'];
        } else {
          $rating = false;
        }

        $data['products'][] = array(
          'product_id'  => $result['product_id'],
          'thumb'       => $image,
          'name'        => $result['name'],
          'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
          'price'       => $price,
          'special'     => $special,
          'tax'         => $tax,
          'rating'      => $result['rating'],
          //'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url)
        );
      }
      
      $json['success'] = $this->language->get('text_success');
      $json['products'] = $data['products'];
      if (isset($this->request->server['HTTP_ORIGIN'])) {
        $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
        $this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        $this->response->addHeader('Access-Control-Max-Age: 1000');
        $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
      }
   
      $this->response->addHeader('Content-Type: application/json');
      $this->response->setOutput(json_encode($json));
  }

  public function getproductdetails() {

    $this->load->language('api/custom');
    $json = array();


    if (isset($this->request->post['product_id'])) {
      $product_id = (int)$this->request->post['product_id'];
    } else {
      $product_id = '';
    }

    $this->load->model('catalog/product');
    
    $product_info = $this->model_catalog_product->getProduct($product_id);

    $this->load->model('tool/image');
    
    if ($product_info['image']) {
      $image = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
    } else {
      $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
    }
    // oveririding the image to get the Http path
    $product_info['image'] = $image;

    $json['product_details'] = $product_info;

    $json['success'] = $this->language->get('text_success');  

    if (isset($this->request->server['HTTP_ORIGIN'])) {
      $this->response->addHeader('Access-Control-Allow-Origin: *');
      //$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
      $this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      $this->response->addHeader('Access-Control-Max-Age: 1000');
      $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }
 
    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));

}

  public function getallcategory() {

    $this->load->language('api/custom');
    $json = array();

    if (!isset($this->session->data['api_id'])) {
      $json['error']['warning'] = $this->language->get('error_permission');
    } else {
      // load model
      $this->load->model('catalog/category');

      $filter_data = array(
        'filter_name' => '',
      ); 
      // get categories
      $categories = $this->model_catalog_category->getAllCategories($filter_data);
      $json['categories'] = $categories;
      $json['success'] = $this->language->get('text_success');
    }
     
     
    if (isset($this->request->server['HTTP_ORIGIN'])) {
      $this->response->addHeader('Access-Control-Allow-Origin: *');
      //$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
      $this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      $this->response->addHeader('Access-Control-Max-Age: 1000');
      $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }
 
    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function getcategory() {

    $this->load->language('api/custom');
    $json = array();

    if (!isset($this->session->data['api_id'])) {
      $json['error']['warning'] = $this->language->get('error_permission');
    } else {
      // load model
      $this->load->model('catalog/category');
 
      // get products
      $categories = $this->model_catalog_category->getCategories();
      $json['categories'] = $categories;
      $json['success'] = $this->language->get('text_success');
    }
     
     
    if (isset($this->request->server['HTTP_ORIGIN'])) {
      $this->response->addHeader('Access-Control-Allow-Origin: *');
      //$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
      $this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      $this->response->addHeader('Access-Control-Max-Age: 1000');
      $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }
 
    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

}