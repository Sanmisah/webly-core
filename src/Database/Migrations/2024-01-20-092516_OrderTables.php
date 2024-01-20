<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'order_no'  => ['type' => 'varchar', 'constraint' => 10, 'null' => true],
            'invoice_no'  => ['type' => 'varchar', 'constraint' => 10, 'null' => true],
            'invoice_date'  => ['type' => 'date', 'null' => true],
            'first_name'  => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'last_name'       => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'email'   => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'mobile'          => ['type' => 'varchar', 'constraint' => 10, 'null' => true],
            'adddress_line_1'          => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'adddress_line_2'          => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'city'          => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'state'          => ['type' => 'varchar', 'constraint' => 100, 'null' => true],
            'pincode'          => ['type' => 'varchar', 'constraint' => 6, 'null' => true],
            'gross_amount'          => ['type' => 'decimal', 'constraint' => "10,2", 'default'=>0, 'null' => false],
            'net_amount'          => ['type' => 'decimal', 'constraint' => "10,2", 'default'=>0, 'null' => false],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('orders', true);      


        $this->forge->addField([
            'id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'order_id'           => ['type' => 'int', 'constraint' => 11],
            'product_id'           => ['type' => 'int', 'constraint' => 11],
            'qty'           => ['type' => 'int', 'constraint' => 11],
            'rate'          => ['type' => 'decimal', 'constraint' => "10,2", 'default'=>0, 'null' => false],
            'amount'          => ['type' => 'decimal', 'constraint' => "10,2", 'default'=>0, 'null' => false],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('order_details', true);      

    }

    public function down()
    {
        $this->forge->createTable('orders', true);      
        $this->forge->createTable('order_details', true);      
    }
}
