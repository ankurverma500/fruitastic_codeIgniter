<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index($cat_id=null,$page=null)
	{
		/*
		$ct=array('Childcare','Residential','Corporate','School');
		$ctl=array('child_care','residential','corporate','school');
		$cnn= array_search('School',$ct);
		echo $wh=$ctl[$cnn];
		exit;		
		$da=array('val'=>'product_id',
				  'table'=>'tbl_product',
				  'where'=>array('status'=>'1','deleted'=>'0'));
		$all_product=$this->common->getdata($da);
		print_r($all_product);
		exit;
		*/
		//$this->load->view('welcome_message');
		$this->data['search_products']='';
		$comment1=array('table'=>'tbl_product as tp',
						'val'=>'*,tp.product_id as product_id, tp.id as id, 
						 tp.product_name as product_name ,tp.cost_per_unit as cost_per_unit',
						'where'=>array("tp.status"=>'1','tp.deleted'=>'0'),
						//,'tcm.status'=>'1','tcm.deleted'=>'0','tcm.availability'=>'1'
						'minvalue'=>'',
						'group_by'=>'',
						'start'=>'',
						'orderby'=>'tp.product_name',//tc.orderby
						'orderas'=>'ASC');
		$multijoin1=array(
			 array('table'=>'tbl_markups as tm','on'=>'tm.product_id=tp.id','join_type'=>''),
			 array('table'=>'tbl_category as tc','on'=>'tc.id=tp.cat_id','join_type'=>'')
		);
		
		if($this->input->get('search_products'))
		{
			$this->data['search_products']=$q=$this->input->get('search_products');
			$this->db->where(" (tp.product_type LIKE '%$q%' OR 
								tp.package_cost LIKE '%$q%' OR   
								tp.unit_per_package LIKE '%$q%' OR
								tp.cost_per_unit LIKE '%$q%' OR
								tp.product_name LIKE '%$q%' OR 
								tp.product_id LIKE '%$q%' OR 
								tc.name LIKE '%$q%') ");
		}
		else
		{
			if($cat_id!=null)
			{
				if($cat_id=='9')
				{
					/*$this->db->where(" ( tm.discount_option=1 OR tm.discount_option=2 ) AND  tm.discount_start_date<='$this->currentAddDate' AND  tm.discount_end_date>='$this->currentAddDate'");*/
					//
					$this->db->where(" ( tm.discount_option=1 OR tm.discount_option=2 ) AND  '$this->currentAddDate' BETWEEN tm.discount_start_date AND tm.discount_end_date");
					$this->data['cat_id']=$cat_id;
				}
				else
				{
					$this->db->where('tc.id',$cat_id);
					$this->data['cat_id']=$cat_id;
				}
			}
			else
			{
				$this->db->where('tc.id','2');
				$this->data['cat_id']='2';
			}
		}
		/*$ppage=10;
		if($page!=null)
		{
			$this->db->limit(10,($page*$ppage));
			//if($limit!='' && $start!=''){
//			   $this->db->limit($limit, $start);
//			}
		}
		else
		{
			$this->db->limit(10, 0);
		}*/
		
		$this->data['result_product']=$this->common->multijoin($comment1,$multijoin1);	
		/*print_r($this->data['result_product']);
		echo ''.$this->db->last_query();
		exit;*/
		$this->data['content']=$this->load->view('product',$this->data,true);
		$this->load->view('layouts/pages',$this->data);
	}
}
