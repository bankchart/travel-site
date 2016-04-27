<?php
// waiting...
class SenderVerification
{
    private $_data;
    private $_validate;
    public function __construct($data, $validate)
    {
        $this->_data = $data;
        $this->_validate = $validate;
    }
    public function input_validate()
    {
        return filter_input($validate, $this->_data);
    }
}

?>
