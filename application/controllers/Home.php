<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();		
	}
	
	public function index()
	{
		$comment1=array('table'=>'tbl_product as tp',
						'val'=>'*,tp.product_id as product_id, tp.id as id, 
						 tp.product_name as product_name ,tp.cost_per_unit as cost_per_unit',
						'where'=>array("tp.status"=>'1','tp.deleted'=>'0'),
						//,'tcm.status'=>'1','tcm.deleted'=>'0','tcm.availability'=>'1'
						'minvalue'=>'',
						'group_by'=>'',
						'start'=>'',
						'orderby'=>'tc.orderby',
						'orderas'=>'DESC');
		$multijoin1=array(
			array('table'=>'tbl_markups as tm','on'=>'tm.product_id=tp.id','join_type'=>'')
			,array('table'=>'tbl_category as tc','on'=>'tc.id=tp.cat_id','join_type'=>'')
		);//discount_start_date  discount_end_date
		//$this->db->where('tm.discount_option','2');
		$this->db->where(array('tm.discount_option'=>'2','tm.discount_start_date<='=>$this->currentAddDate,'tm.discount_end_date>='=>$this->currentAddDate));
		//$this->db->where('('.$this->currentAddDate.' BETWEEN tcm.discount_start_date AND tcm.discount_end_date)');
		$this->data['discount_product']=$discount_product=$this->common->multijoin($comment1,$multijoin1);	
		/*print_r($this->data['discount_product']);
		echo $this->db->last_query();
		exit;*/
		$i=0;
		$ppp=array();
		if($discount_product['res'])
		{
			foreach( $discount_product['rows'] as $result_products)
			{ 
				//$res=get_product_final_price_by_customer_type($customer_id,$row->customer_type,$result_products->id,$result_products);
				$cur_date=date('Y-m-d');
				$customer_id='';
				$customer_type='Residential';
				if($this->session->userdata('admin_login'))
				{
					$customer_id=$this->added_by;
					$customer_type=$this->customer_type;
				}
				$result_products->id;
				//echo '<pre>';
				//print_r($discount_product);
				
				$availability				=	unserialize($result_products->availability);
				$cust_type					=	unserialize($result_products->cust_type);
				$cost_per_unit_marker		=	unserialize($result_products->cost_per_unit_marker);
				$cost_before_tax			=	unserialize($result_products->cost_before_tax);
				$selling_price_after_tax	=	unserialize($result_products->selling_price_after_tax);
				$cpo=array_search($customer_type,$cust_type);
				//print_r($cust_type);
				//exit;
				if(in_array($cpo+1,$availability))
				{
					$discount_option	=$result_products->discount_option;
					$clearence_amount	=$result_products->clearence_amount;
					$discount_start_date=$result_products->discount_start_date;
					$discount_end_date	=$result_products->discount_end_date;
					$discounted			=$result_products->discounted;
					if($discount_option==1)
					{
						if($cur_date>=$discount_start_date && $cur_date<=$discount_end_date)
						{
							$rows['sel_price'] = $clearence_amount;
						}
						else
						{
							$rows['sel_price'] = $selling_price_after_tax[$cpo];
							$rows['discount_option']=0;
						}
					}
					elseif($discount_option==2)
					{						
						if($cur_date>=$discount_start_date && $cur_date<=$discount_end_date)
						{
						   $disc_price = (($selling_price_after_tax[$cpo]*$discounted)/100);
						   $rows['sel_price']= ($selling_price_after_tax[$cpo]-$disc_price);
						   $ppp[$result_products->id]=array('sel_price'=>$rows['sel_price'],'was_price'=>$selling_price_after_tax[$cpo],'discount_option'=>'1');					  
						}
						else
						{
							$rows['sel_price'] = $selling_price_after_tax[$cpo];
							$rows['discount_option']=0;
							$ppp[$result_products->id]=array('sel_price'=>$rows['sel_price'],'was_price'=>$selling_price_after_tax[$cpo],'discount_option'=>'0');
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
					//return array('res'=>true,'price'=>$rows['sel_price']);
				}
				else
				{
					//return array('res'=>false);
				}
				$i++;
			}
		}
		$this->data['discount_product_exist']=$ppp;
		//print_r($ppp);
		//exit;
		//$this->db->where('tm.discount_option','1');		
		/*$this->db->where(array('tm.discount_option'=>'1','tm.discount_start_date<='=>$this->currentAddDate,'tm.discount_end_date>='=>$this->currentAddDate));
		$this->data['clearence_product']=$this->common->multijoin($comment1,$multijoin1);*/
		
		$this->data['content']=$this->load->view('home/index',$this->data,true);
		$this->load->view('layouts/checkout',$this->data);
	}
}
