<?php

namespace mvc\date {
use mvc\i18n\i18nClass as i18n;
    /**
     * Description of autoLoadClass
     *
     * @author Roosevelt Diaz <rdiaz02@misena.edu.co>
     */
    class dateClass {

        private static $instance;

        /**
         *
         * @return dateClass
         */
        public static function getInstance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function day() {
            $day = date("D");
            $flag = false;
            if ($day == "Mon") {
                $day =  i18n::__('lunes', null);
                $flag = true;
            }
            if ($day == "Tue") {
                $day =  i18n::__('martes', null);
                $flag = true;
            }
            if ($day == "Wen") {
                $day =  i18n::__('miercoles', null);
                $flag = true;
            }
            if ($day == "Thu") {
                $day =  i18n::__('jueves', null);
                $flag = true;
            }
            if ($day == "Fri") {
                $day =  i18n::__('viernes', null);
                $flag = true;
            }
            if ($day == "Sat") {
                $day = i18n::__('sabado', null);
                $flag = true;
            }
            if ($day == "Sun") {
                $day = i18n::__('domingo', null);
                $flag = true;
            }
            if($flag == true){
                return $day;
            }

        }

        public function month(){
            $month = date("M");
            $flag = false;
            if($month == "Jan"){
                $month = i18n::__('enero', null);
                $flag = true;
            }
            if($month == "Feb"){
                $month = i18n::__('febrero', null);
                $flag = true;
            }
            
            if($month == "Mar"){
                $month = i18n::__('marzo', null);
                $flag = true;
            }
            
            if($month == "Apr"){
                $month = i18n::__('abril', null);
                $flag = true;
            }
            
            if($month == "May"){
                $month = i18n::__('mayo', null);
                $flag = true;
            }
            
            if($month == "Jun"){
                $month = i18n::__('junio', null);
                $flag = true;
            }
            
            if($month == "Jul"){
                $month = i18n::__('julio', null);
                $flag = true;
            }
            
            if($month == "Aug"){
                $month = i18n::__('agosto',null);
                $flag = true;
            }
            
            if($month == "Sep"){
                $month =i18n::__('septiembre', null);
                $flag = true;
            }
            
            if($month == "Oct"){
                $month = i18n::__('octubre', null);
                $flag = true;
            }
            
            if($month == "Nov"){
                $month = i18n::__('noviembre', null);
                $flag = true;
            }
            
            if($month == "Dec"){
                $month = i18n::__('diciembre', null);
                $flag = true;
            }
            if($flag == true){
                return $month;
            }
        }
    }

}

