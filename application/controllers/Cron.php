<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("cron_model", "login_model", "logs_model"));
        $this->load->library(array('session'));

        $this->session->site_lang = 'spanish';
    }

    public function index()
    {
        echo "Controller Cron";
    }

    /**
     * RUN: php /var/www/html/sgcb.development.com/public_html/index.php cron updateExpiration
     */
    public function updateExpiration()
    {
        // if (!is_cli()) {
        //     show_404();
        // }
        
        $firstDate  = new DateTime(date("Y-m-d"));

        $response = $this->cron_model->updateExpirationCerts();

        if ($response) {
            foreach ($response as $key => $value) {
                $secondDate = new DateTime($value['expired_certificated']);
                $intvl = $firstDate->diff($secondDate);
    
                if ($intvl->y == 0 && $intvl->m == 0 && $intvl->d > 0) {
                    $this->cron_model->updateDaysCerts($value['id'], 'VENCE EN', $intvl->d);
                }
    
                if ($intvl->y == 0 && $intvl->m == 0 && $intvl->d == 0) {
                    $this->cron_model->updateDaysCerts($value['id'], 'VENCIDO', $intvl->d);
                   
                }
    
                if(date("Y-m-d") > date($value['expired_certificated'])){
                    $this->cron_model->updateDaysCerts($value['id'], 'VENCIDO', 0);
                }
            }

            echo "Vencimentos Finais!! \n";
        }else {
            echo "Não há expirações!! \n";
        }
        
    }

    

}