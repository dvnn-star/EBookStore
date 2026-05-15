<?php

class TransactionModel_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('TransactionModel');
        $this->obj = $this->CI->TransactionModel;
    }

    public function test_get_pagination_is_array()
    {
        // Tes sederhana: pastikan fungsi mengembalikan array
        $output = $this->obj->GetPaginationTransactions(10, 0);
        $this->assertIsArray($output);
    }
}