<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use XBase\Table;

class DBFController extends Controller
{
    public function __invoke($offset = 1)
    {
        $perPage = 20;
        $start_time = microtime(true);
        // $table = new Table('../dbf_files/MSMHS.DBF', ["nimhsmsmhs", "nmmhsmsmhs", "tplhrmsmhs", "tglhrmsmhs", "kdjekmsmhs", "tahunmsmhs"]);
        $table = new Table('../dbf_files/dbase.dbf');
        $tableColumns = array_keys($table->columns);
        $table->moveTo((($offset-1)*$perPage)-1); // Row Offset, Start from -1

        $hal = ceil($table->recordCount / $perPage);
        $links = [];

        if($offset > 4)
            $links[] = "<a href='".route("page", ["offset"=>1])."'>1</a>";
        if($offset > 5)
            $links[] = "...";

        for ($i=0; $i < $hal; $i++) {
            $pageNum = $i+1;
            if($offset == $pageNum) {
                $links[] = "<span>$pageNum</span>";
                continue;
            }

            if($pageNum >= ($offset-3) && $pageNum <= ($offset+3))
                $links[] = "<a href='".route("page", ["offset"=>$pageNum])."'>$pageNum</a>";
        }

        if($offset <= ($hal-5))
            $links[] = "...";
        if($offset <= ($hal-4))
            $links[] = "<a href='".route("page", ["offset"=>$hal])."'>$hal</a>";

        $returnData = [
            "tableColumns"=>$tableColumns,
            "datas"=>$table,
            "start_time"=>$start_time,
            "perPage"=>$perPage,
            "offset"=>$offset,
            "links"=>implode(" ", $links)
        ];
        return view("dbf_list", $returnData);
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
			'file' => 'required'
        ]);

        $file = $request->file('file');
        $tes = $file->move('../dbf_files/','dbase.dbf');
        return redirect()->route('index')->with('status', 'Success');
    }
}
