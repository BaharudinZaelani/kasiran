<?php 



class ConsoleDatabase {
    
    public function displayDatabaseSetup(){
        print "======================================================";
        print "\n";
        print "                Kasiran - Setup\n";
        print "\n";
        print "======================================================\n";
        print "1. Create Database " . DB_NAME . "\n";
        print "2. Delete Database " . DB_NAME . "\n";
        print "3. Exit \n";
    }

    public function displayTabelSetup(){
        print "======================================================";
        print "\n";
        print "                Kasiran - Setup\n";
        print "\n";
        print "======================================================\n";
        print "1. Setup Tabel ( Membuat semua tabel yang dibutuhkan aplikasi )\n";
        print "2. Seed Admin ( Menambahkan 1 data admin pada database )\n";
        print "3. Exit \n";
    }

    public function createdb(){
        global $db;
        $db = new Database();
        print "Database created!\n";
    }
}