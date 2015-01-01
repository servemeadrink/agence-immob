<?php
class Controller 
{
   public $load;
   public $model;

   function __construct()
   {
      $this->load = new Load();
      $this->model = new Model();
      
      if (isset($_GET['page']) && $_GET['page']=='agence')
      {
         if (isset($_GET['id'])) {
            $this->agence($_GET['id']);
         }
         return;
      }
      else if (isset($_GET['page']) && $_GET['page']=='annonce')
      {
         if (isset($_GET['man_id'])) {
            $this->annonce($_GET['man_id']);
         }
         return;
      }
      else
      {
         $this->home(0, 10);
      }
   }

   function home($limite, $offset)
   {
      $data = array();
      $data["agences"] = $this->model->lire_agences($limite, $offset);
      $data["annonces"]  = $this->model->lire_annonces(false);
      $this->load->view('agences.php', $data);
   }

   function all($offset = 0, $limite = 200){
      $data = $this->model->lire_agences($offset, $limite);
      $this->load->view('agences.php', $data);
   }
   function agence($id){
      $data['agence'] = $this->model->lire_agence($id);
      $data["annonces"]  = $this->model->lire_annonces($id);
      $this->load->view('agence.php', $data);
   }
   function annonce($id){
      $data['annonce'] = $this->model->lire_annonce($id);
      $data['agence'] = $this->model->lire_agence($data['annonce']['AGE_ID']);
      $data['photos'] = $this->model->getMandatPhotos($id);
      $this->load->view('annonce.php', $data);
   }
   
   function redirect($page, $speed){
      header('Location:index.php?page='.$page.'&speed='/$speed);
   }
}
