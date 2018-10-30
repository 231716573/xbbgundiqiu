<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Http\Model\Config;

class ConfigController extends Controller
{
	// get.admin.config 全部系统配置列表
    public function index()
    {
    	$data = Config::orderBy('config_order', 'asc')->get();

    	// 处理config_content
    	foreach ($data as $k => $v) {
    		switch ($v->field_type) {
    			case 'input':
    				$data[$k]->_html = '<input type="text" class="lg form-control" name="config_content[]" value="'.$v->config_content.'">';
    				break;
    			case 'textarea':
    				$data[$k]->_html = '<textarea type="text" class="lg form-control" name="config_content[]">'.$v->config_content.'</textarea>';
    				break;
    			case 'radio':
    				// 1|开启,0|关闭
    				$arr = explode(',', $v->field_value); // explode 拆分成数组，类似JS的split
    				$str = '';
    				foreach ($arr as $m => $n) {
    					// 1|开启
    					$r = explode('|', $n); // explode 拆分成数组，类似JS的split
    					$c = $v->config_content == $r[0] ? ' checked ' : '';
    					$str .= '<input type="radio" style="vertical-align: bottom; margin-bottom:3px;" name="config_content[]" value="'.$r[0].'"'.$c.'> '.$r[1].'　';
    				}
    				$data[$k]->_html = $str;
    				break;

    		}
    	}

    	return view('admin.config.index', compact('data'));
    }

    public function changecontent(Request $request)
    {
    	$input = Input::all();
    	foreach($input['config_id'] as $k => $v)
    	{
    		Config::where('config_id', $v)->update(['config_content'=>$input['config_content'][$k]]);
    	}
    	$this->putFile();

    	return back()->with('errors', '配置项更新成功！');
    }

    public function putFile()
    {
    	$config = Config::pluck('config_content', 'config_name')->all(); // pluck筛选指定数据
    	
    	$path = base_path() . '\config\web.php';

    	$str = '<?php return '.var_export($config, true).' ;'; // var_export 数组转成字符串

    	file_put_contents($path, $str); // file_put_contents  把内容$str写入文件$path 中
    }

    // 系统配置排序
    public function changeOrder()
    {
    	$input = Input::all();
    	$config = Config::find($input['config_id']);
    	$config->config_order = $input['config_order'];
    	$re = $config->update();
    	if( $re ){
    		$data = [
    			'status' => 0,
                'msg'    => '系统配置排序更新成功！',
    		];
    	}else{
			$data = [
    			'status' => 1,
                'msg'    => '系统配置排序更新失败，请稍后重试！',
    		];
    	}
        $this->putFile();
    	return $data;
    }
    
    //get.admin/config/create   添加系统配置
    public function create()
    {
    	return view('admin.config.add');
    }

    // post.admin/config   添加系统配置提交
    public function store()
    {
    	$input = Input::except('_token');
    	$rules = [
    		'config_name'  => 'required',
    		'config_title'   => 'required',
    	];

    	$message = [
    		'config_name.required'  => '系统配置名称不能为空！',
    		'config_title.required'   => '系统配置URL不能为空！',
    	];

    	$validator = Validator::make($input, $rules, $message);

    	if( $validator->passes() ){
    		$re = Config::create($input);
    		if( $re ){
                $this->putFile();
    			return redirect('admin/config');
    		}else{
    			return back()->with('errors','系统配置失败，请稍后重试！');
    		}
    	}else{
    		return back()->withErrors($validator);
    	}
    }

    // get.admin/config/{config_id}/edit  编辑系统配置
    public function edit($config_id)
    {
    	$field = Config::find($config_id);
    	return view('admin.config.edit', compact('field'));
    }

    // put.admin/config/{config_id}  更新系统配置
    public function update($config_id)
    {
    	$input = Input::except('_method', '_token');
    	$re = Config::where('config_id', $config_id)->update($input);
    	if( $re ){
    		$this->putFile();
    		return redirect('admin/config');
    	}else{
    		return back()->with('errors','系统配置更新失败，请稍后重试！');
    	}
    }

    // delete.admin/config/{config_id}   删除系统配置
    public function destroy($config_id)
    {
    	$re = Config::where('config_id', $config_id)->delete();
    	if($re){
    		$this->putFile();
    		$data = [
    			'status' => 0,
    			'msg'    => '系统配置删除成功！',
    		];
    	}else{
    		$data = [
    			'status' => 1,
    			'msg'    => '系统配置删除失败，请稍后重试！',
    		];
    	}

    	return $data;
    }
}