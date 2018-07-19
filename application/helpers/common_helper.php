<?php 
ini_set('display_errors', 0); 
error_reporting(E_ALL);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('get_product_final_price_by_customer_type') )
{
function get_product_final_price_by_customer_type($customer_id,$customer_type,$product_id,$result_product)
	{
		$cur_date=date('Y-m-d');
        $ci =& get_instance();
        $ci->load->database();
		$ci->load->model('common');
		$comment1=array('table'=>'tbl_product as tp',
								'val'=>'*,tp.product_id as product_id, tp.id as id, 
								tp.product_name as product_name ,tp.cost_per_unit as cost_per_unit',
								'where'=>array("tp.status"=>'1','tp.id'=>$product_id),
								'minvalue'=>'',
								'group_by'=>'',
								'start'=>'',
								'orderby'=>'tp.id',
								'orderas'=>'ASC'); 
				$multijoin1=array(
					array('table'=>'tbl_markups as tm','on'=>'tm.product_id=tp.id','join_type'=>'left')
					//array('table'=>'tbl_product_box as tpb','on'=>'tpb.product_id==tp.id','join_type'=>'left')           
				);
				$result_product=$ci->common->multijoin($comment1,$multijoin1);				
		/*	
		SELECT 
	SUBSTRING_INDEX(SUBSTRING_INDEX(`selling_price_after_tax`,';',1),':',-1) AS fieldname1,
	SUBSTRING_INDEX(SUBSTRING_INDEX(selling_price_after_tax,';',2),':',-1) AS fieldvalue2,
	SUBSTRING_INDEX(SUBSTRING_INDEX(selling_price_after_tax,';',3),':',-1) AS fieldname3,
	SUBSTRING_INDEX(SUBSTRING_INDEX(selling_price_after_tax,';',4),':',-1) AS fieldvalue4
	FROM tbl_markups;
	
		*/
				
		$availability				=	unserialize($result_product['rows'][0]->availability);
		$cust_type					=	unserialize($result_product['rows'][0]->cust_type);
		$cost_per_unit_marker		=	unserialize($result_product['rows'][0]->cost_per_unit_marker);
		$cost_before_tax			=	unserialize($result_product['rows'][0]->cost_before_tax);
		$selling_price_after_tax	=	unserialize($result_product['rows'][0]->selling_price_after_tax);
		$pgst	=unserialize($result_product['rows'][0]->tax);
			
			$cpo=array_search($customer_type,$cust_type);
			if(in_array($cpo+1,$availability))
			{
				$rows['was_price']=$selling_price_after_tax[$cpo];
				$ddty='0';
				$discount_option	=$result_product['rows'][0]->discount_option;
				$clearence_amount	=$result_product['rows'][0]->clearence_amount;
				$discount_start_date=$result_product['rows'][0]->discount_start_date;
				$discount_end_date	=$result_product['rows'][0]->discount_end_date;
				$discounted			=$result_product['rows'][0]->discounted;
				$dad['gst']			=$result_product['rows'][0]->gst;
				
				$dad['product_gst']=$pgst[$cpo];
				if($discount_option==1)
				{
					$ddty=1;
					if($cur_date>=$discount_start_date && $cur_date<=$discount_end_date)
					{
						$rows['sel_price'] = $clearence_amount;
						$rows['discount_option']=1;
					}
					else
					{
						$rows['sel_price'] = $selling_price_after_tax[$cpo];
						$rows['discount_option']=0;
					}
				}
				elseif($discount_option==2)
				{
					$ddty=2;
					if($cur_date>=$discount_start_date && $cur_date<=$discount_end_date)
					{
					   $disc_price = (($selling_price_after_tax[$cpo]*$discounted)/100);
					   $rows['sel_price']= ($selling_price_after_tax[$cpo]-$disc_price);	
					   $rows['discount_option']=1;				  
					}
					else
					{
						$rows['sel_price'] = $selling_price_after_tax[$cpo];
						$rows['discount_option']=0;
					}
				}
				else
				{
					$rows['sel_price'] = $selling_price_after_tax[$cpo];
				}
				/*echo $cur_date;
				echo $rows['sel_price'];
				echo '<pre>';
				print_r($result_product);
				exit;*/
				$dada =array('res'=>true,'price'=>$rows['sel_price'],'discount_option'=>$rows['discount_option'],'discount_type'=>$ddty,'was_price'=>$rows['was_price']);
				return array_merge((array)$dad,(array)$dada);
			}
			else
			{
				return array('res'=>false);
			}		
	}
}
 if ( ! function_exists('get_day_name'))
{
   function get_day_name()
   {
	   return $array=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
   }
}

if ( ! function_exists('get_order_run_detail_by_session'))
{
   function get_order_run_detail_by_session($order_id=null,$customer_id=null,$order_type=null)
   {
	 
	   /* exit;*/
	    $ci =& get_instance();
	   $ci->load->database();
	   $ci->load->library('session'); 
	   $ci->load->model('common');
	   $data=array();
	   $data['run_detail_id']='';
	   $data['run_day']='';
	   $data['run_date']='';
	   if($order_type=='one_time')
	   {
		   /*$da=array('val'=>'*',
					  'table'=>'tbl_recurring_order',
					  'where'=>array('order_id'=>$order_id,'customer_id'=>$customer_id));
			$rec_order=$ci->common->getdata($da);
			$one_time_order=$rec_order['rows'][0];
			$data['run_detail_id']=$one_time_order->run_detail_id;
			$data['run_day']=$one_time_order->on_days;
			$data['run_date']=$one_time_order->run_date;*/	
	   }
		if($order_type=='recurring')
		{
			if($ci->session->userdata('run_detail'))
			{
				$run_detail=$ci->session->userdata('run_detail');
				if($run_detail['run_type']==2)
				{
					$j=0;
					foreach($run_detail['run'] as $rec_order)
					{
						$data['run_detail_id'][$j]=$rec_order['run_detail_id'];
						$data['run_day'][$j]=$rec_order['run_day_name'];
						$data['run_date'][$j]=$rec_order['run_date'];	
						$j++;
					}
				}
			}
		   
		}
		if($order_type=='fornightly')
		{
		   if($ci->session->userdata('run_detail'))
			{
				$run_detail=$ci->session->userdata('run_detail');
				if($run_detail['run_type']==3)
				{
					$j=0;
					foreach($run_detail['run'] as $rec_order)
					{
						$data['run_detail_id'][$j]=$rec_order['run_detail_id'];
						$data['run_day'][$j]=$rec_order['run_day_name'];
						$data['run_date'][$j]=$rec_order['run_date'];	
						$j++;
					}
				}
			}
		}
	/* $da=array('val'=>'zip_code',
			  'table'=>'tbl_order',
			  'where'=>array('id'=>$order_id,'user_id'=>$customer_id));
	$zip_code=$ci->common->getdata($da);
	$data['zip_code']=$zip_code['rows'][0]->zip_code;*/
	return $data;
				
   }
}
 if ( ! function_exists('get_order_run_detail'))
{
   function get_order_run_detail($order_id=null,$customer_id=null,$order_type=null)
   {
	    $ci =& get_instance();
	   $ci->load->database();
	    $ci->load->model('common');
	   $data=array();
	   $data['run_detail_id']='';
	   $data['run_day']='';
	   $data['run_date']='';
	   if($order_type=='one_time')
	   {
		   $da=array('val'=>'*',
					  'table'=>'tbl_recurring_order',
					  'where'=>array('order_id'=>$order_id,'customer_id'=>$customer_id));
			$rec_order=$ci->common->getdata($da);
			$one_time_order=$rec_order['rows'][0];
			$data['run_detail_id']=$one_time_order->run_detail_id;
			$data['run_day']=$one_time_order->on_days;
			$data['run_date']=$one_time_order->run_date;	
	   }
		if($order_type=='recurring')
		{
		   $da=array('val'=>'*',
					  'table'=>'tbl_recurring_order_master',
					  'where'=>array('order_id'=>$order_id,'customer_id'=>$customer_id,'fortnight'=>'0'));
			$recurring_order=$ci->common->getdata($da);
			if($recurring_order['res'])
			{
				$j=0;
				foreach( $recurring_order['rows'] as $rec_order)
				{
					$data['run_detail_id'][$j]=$rec_order->run_detail_id;
					$data['run_day'][$j]=$rec_order->on_days;
					$data['run_date'][$j]=$rec_order->run_date;	
					$j++;
				}
			}
		}
		if($order_type=='fornightly')
		{
		   $da=array('val'=>'*',
					  'table'=>'tbl_recurring_order_master',
					  'where'=>array('order_id'=>$order_id,'customer_id'=>$customer_id,'fortnight'=>'1'));
			$recurring_order=$ci->common->getdata($da);
			if($recurring_order['res'])
			{
				$j=0;
				foreach( $recurring_order['rows'] as $rec_order)
				{
					$data['run_detail_id'][$j]=$rec_order->run_detail_id;
					$data['run_day'][$j]=$rec_order->on_days;
					$data['run_date'][$j]=$rec_order->run_date;	
					$j++;
				}
			}
		}
	 $da=array('val'=>'zip_code',
			  'table'=>'tbl_order',
			  'where'=>array('id'=>$order_id,'user_id'=>$customer_id));
	$zip_code=$ci->common->getdata($da);
	$data['zip_code']=$zip_code['rows'][0]->zip_code;
	return $data;
				
   }
}


if ( ! function_exists('get_date_site_format'))
{
	function get_date_site_format($date)
	{
		return   date('d-M-Y',strtotime($date));
	}
}
if ( ! function_exists('get_date_time_site_format'))
{
	function get_date_time_site_format($date)
	{
		return   date('d-M-Y H:i:s',strtotime($date));
	}
}

if ( ! function_exists('get_login_api_token'))
{
	function get_login_api_token()
	{
	$arr = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ35879612'); // get all the characters into an array
    shuffle($arr); // randomize the array
    $arr = array_slice($arr, 0, 6); // get the first six (random) characters out
    $token = implode('', $arr);
	return $token;
	}
}