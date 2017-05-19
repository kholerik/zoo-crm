<?php
namespace app\components;

use yii\base\Component;

class Date extends Component{
    private $date;
    public function convertDate($date){
        $ru_month = array( 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' );
        $en_month = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
        $date = date_parse_from_format( "F j Y", str_replace( $ru_month, $en_month, $date ));
        $this->date = $date['year']."-".$date['month']."-".$date['day'];
        return $this;
    }

    public function toTimestamp(){
        return strtotime($this->date);
    }

    public function toDate(){
        return $this->date;
    }

    public function toDateWithZero(){
        return date("Y-m-d",strtotime($this->date));
    }

}