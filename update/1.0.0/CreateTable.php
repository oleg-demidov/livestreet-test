<?php

class PluginTest_Update_CreateTable extends ModulePluginManager_EntityUpdate
{
    /**
     * Выполняется при обновлении версии
     */
    public function up()
    {
        if($this->exportSQL(Plugin::GetPath(__CLASS__) . '/update/1.0.0/dump_test.sql')){
            $this->Message_AddNoticeSingle('Создана таблица test');
        }
        if($this->exportSQL(Plugin::GetPath(__CLASS__) . '/update/1.0.0/dump_ask.sql')){
            $this->Message_AddNoticeSingle('Создана таблица ask');
        }
        if($this->exportSQL(Plugin::GetPath(__CLASS__) . '/update/1.0.0/dump_ans.sql')){
            $this->Message_AddNoticeSingle('Создана таблица ans');
        }
        if($this->exportSQL(Plugin::GetPath(__CLASS__) . '/update/1.0.0/dump_bilet.sql')){
            $this->Message_AddNoticeSingle('Создана таблица bilet');
        }
        if($this->exportSQL(Plugin::GetPath(__CLASS__) . '/update/1.0.0/dump_result.sql')){
            $this->Message_AddNoticeSingle('Создана таблица result');
        }
    }

    /**
     * Выполняется при откате версии
     */
    public function down()
    {
         $this->exportSQL(Plugin::GetPath(__CLASS__) . '/update/1.0.0/drop_dump.sql');
    }
}