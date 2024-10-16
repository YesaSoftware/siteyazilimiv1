<?php
// app/View/Components/DataTable.php
namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $columns;
    public $columnsText;
    public $route;
    public $options;
    public $columnButtons; // Yeni property

    public function __construct( $columns, $columnsText, $route, $options = [], $columnButtons = [])
    {
        $this->columns = $columns;
        $this->columnsText = $columnsText;
        $this->route = $route;
        $this->options = $options;
        $this->columnButtons = $columnButtons; // Yeni property'i ayarlıyoruz
    }

    public function render()
    {
        return view('components.data-table');
    }
}
