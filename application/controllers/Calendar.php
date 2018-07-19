<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Calendar extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();	
			
		$this->load->model('common');			
	}
	function get_post_code_of_run_helper_ajax($post_code,$order_id=null,$customer_id=null)
	{
		$cur_date=date('Y-m-d',date(strtotime("+1 day", strtotime(date('Y-m-d')))));
		$comment1=array('table'=>'tbl_run_detail as trd',
						'val'=>'*,trd.run_date,trd.id as run_detail_id
						,(SELECT `name` FROM `tbl_working_shift` WHERE id=trd.shift) as shift_name 
						',
						//,	(SELECT count(*) FROM `tbl_recurring_order` WHERE `order_id`='.$order_id.' AND  `customer_id`='.$customer_id.' AND `run_detail_id`=trd.id ) as recorder_exists
						'where'=>array('trd.deleted'=>'0','trd.status'=>'1','trz.zip_code'=>$post_code),
						//,'trd.id'=>'76' ,'trd.run_date'=>'2018-01-01'
						//'trz.max_deliveries < trz.total_deliveries'
						'minvalue'=>'',
						//'group_by'=>'trd.id',
						'group_by'=>'trd.run_date,trd.shift',
						'start'=>'',
						'orderby'=>'trd.run_date',
						'orderas'=>'ASC');	
				$multijoin1=array(
					array('table'=>'tbl_run_zip as trz','on'=>'trz.run_id=trd.tbl_run_id AND trz.status=1','join_type'=>'left')           
					);
		
		if(date('H')>='15:00')
		{
			$this->db->where('trd.run_date>',date('Y-m-d',date(strtotime("+1 day", strtotime($cur_date)))));
		}
		else
		{
			$this->db->where('trd.run_date>',$cur_date);
		}
		$all_run_day=$this->common->multijoin($comment1,$multijoin1);
		
		/*echo '<pre>';
		print_r($all_run_day);
		exit;*/
		$res='';
		$res2='';
		$res3=array();
		$years_ar=array();
		$months_ar=array();
		$days_ar=array();
		$events_ar=array();
		$years='';
		$months='';
		$days='';
		$events='';
		
		/*$years_ct=0;
		$months_ct=0;
		$days_ct=0;
		$events_ct=0;*/
		//echo date("j",strtotime('2017-01-05'));
		$eee='';
		if($all_run_day['res'])
		{			
			foreach($all_run_day['rows'] as  $rn)
			{
				/*$function="add_run_in_session('".$rn->run_detail_id."','".$rn->run_date."','".$rn->run_day."')";
				$text='<span id="selected_run_'.$rn->run_detail_id.'" style="cursor:pointer;" onclick="'.$function.'">Click here to select your run id  :- '.$rn->run_counter_id.'_'.$rn->shift_name.'</span>';*/
				
				$sssss= $rn->shift_name=='AM'?'AM(8am - 12pm)':'PM(12pm - 4pm)';
				$function="add_run_in_session('".$rn->run_detail_id."','".$rn->run_date."','".$rn->run_day."')";
				$text='<span id="selected_run_'.$rn->run_detail_id.'" style="cursor:pointer;" onclick="'.$function.'"> '.$rn->shift_name.' '.$sssss.'</span>';
				
				$text='<div class="radio" style="border-right: none !important ">
							<input type="radio" onclick="'.$function.'" run_detail_id="'.$rn->run_detail_id.'" name="'.$rn->run_day.'" tbl_run_id="'.$rn->tbl_run_id.'" id="'.$rn->run_day.'_'.$rn->run_detail_id.'" run_date="'.$rn->run_date.'" run_day="'.$rn->run_day.'">
							<label for="'.$rn->run_day.'_'.$rn->run_detail_id.'">
							'.$sssss.'                  
							</label>
						  </div>';
				
				$eee[date('Y',strtotime($rn->run_date))]
					[date('n',strtotime($rn->run_date))]
					[date("j",strtotime($rn->run_date))]
												 [$rn->shift_name]=array('shift'=>$rn->shift_name,
																		   'run_detail_id'=>$rn->run_detail_id,
																		   'run_day'=>$rn->run_day,
																		   'run_date'=>$rn->run_date,
																		   'startTime'=>'00:00',
																		   'endTime'=>'00:30',
																		   'mTime'=>$rn->shift_name,
																		   'text'=>$text);
			}			
		}		
		/*print_r(json_encode($eee));
		exit;*/
		//return $eee;
		$years_ct=0;
		
		//echo count($eee);
		if(is_array($eee))
		{
			foreach($eee as $ykey=>$yval)
			{				
				//$res3[$ykey] []= array($years_ct);
				if(is_array($yval))
				{
					$months_ct=0;
					foreach($yval as $mkey=>$mval)
					{						
						//$res3[$ykey][$years_ct][$mkey][]=array($months_ct);
						if(is_array($mval))
						{
							$days_ct=0;		
							foreach($mval as $dkey=>$dval)
							{
							//	$res3[$ykey][$years_ct][$mkey][$months_ct][$dkey]=array($days_ct);
								if(is_array($dval))
								{
									$events_ct=0;									
									foreach($dval as $ekey=>$eval)
									{
										/*echo '<pre>';
										print_r( $dval);
										print_r($eval);*/
										//exit;	
										$res3[$ykey][$mkey][$dkey][]=$eval;	
										//$res3[$ykey][$years_ct][$mkey][$months_ct][$dkey][$days_ct][]=$eval;	
										$events_ct++;
									}
								}
								$days_ct++;
							}
						}
						$months_ct++;
					}
				}
				$years_ct++;
			}
		}
		//echo '<pre>';
		print_r(json_encode($res3));
	}
	
	
	
	public function check_post_code_with_address_popup()
	{	
		$post_code_with_address=$this->input->post('post_code_with_address');
		if($post_code_with_address==null || $post_code_with_address=='')
		{
			echo 'Oops Sorry!. invalid address Please try again';
		}
		else
		{	
			$this->session->set_userdata('product_detail','');
			$data_c['zip_code']=$post_code_with_address;
			/*$r_add_dl=$this->get_google_address_with_detail($post_code_with_address);
			$data_c['formated_address']=$r_add_dl['f_address'];
			$data_c['main_address']=$r_add_dl['main_address'];
			$data_c['main_city']=$r_add_dl['main_city'];
			$data_c['main_state']=$r_add_dl['main_state'];
			$data_c['zip_code']=$r_add_dl['pincode'];
			$data_c['longitude']=$r_add_dl['longitude'];
			$data_c['latitude']=$r_add_dl['latitude'];*/
			
			$all_run_day=$this->common->ex_query("select * from tbl_zipcode where zipcode ='".$data_c['zip_code']."'");
			if(!$all_run_day['res'])
			{
				echo "We currently don't have free delivery to your area, however, please click on live chat to discuss delivery fee and options, or send us an enquiry to find out delivery options.";
			}
			else
			{	
				//print_r($r_add_dl);				
				//echo 'Congrats!! We deliver to your area with Free Delivery! subject to minimum spend of $40.';				
				//$this->session->set_userdata('run_post_code_with_address',$data_c['formated_address']);				
				$this->session->set_userdata('run_post_code',$data_c['zip_code']);
				$this->session->set_flashdata('success', 'Congrats!! We deliver to your area with Free Delivery! subject to minimum spend of $40.');	
				echo 'success';
			}
		}
	}
	public function check_post_code()
	{	
		$post_code=$this->input->post('post_code');
		if($post_code==null || $post_code=='')
		{
			$this->session->set_flashdata('error', 'Oops Sorry!. invalid post code Please contact admin');				
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
		else
		{	
			/*$cur_date=date('Y-m-d',date(strtotime("+1 day", strtotime(date('Y-m-d')))));
			$comment1=array('table'=>'tbl_run_detail as trd',
							'val'=>'*,trd.run_date,trd.id as run_detail_id
							,(SELECT `name` FROM `tbl_working_shift` WHERE id=trd.shift) as shift_name 
							',
							'where'=>array('trd.deleted'=>'0','trd.status'=>'1','trz.zip_code'=>$post_code),
							'minvalue'=>'',
							'group_by'=>'trd.run_date,trd.shift',
							'start'=>'',
							'orderby'=>'trd.run_date',
							'orderas'=>'ASC');	
					$multijoin1=array(
						array('table'=>'tbl_run_zip as trz','on'=>'trz.run_id=trd.tbl_run_id AND trz.status=1','join_type'=>'left')           
						);
			
			if(date('H')>='15:00')
			{
				$this->db->where('trd.run_date>',date('Y-m-d',date(strtotime("+1 day", strtotime($cur_date)))));
			}
			else
			{
				$this->db->where('trd.run_date>',$cur_date);
			}
			$all_run_day=$this->common->multijoin($comment1,$multijoin1);*/
			$all_run_day=$this->common->ex_query("select * from tbl_zipcode where zipcode ='$post_code'");
			if(!$all_run_day['res'])
			{
				$this->session->set_flashdata('error', "We currently don't have free delivery to your area, however, please click on live chat to discuss delivery fee and options, or send us an enquiry to find out delivery options and fees here.");				
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
			else
			{	
				$this->session->set_flashdata('success', 'Congrats!! We deliver to your area with Free Delivery! subject to minimum spend of $40.');					
				$this->session->set_userdata('run_post_code',$post_code);
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
		}
	}
	
	public function check_post_code_index()
	{	
		$post_code=$this->input->post('post_code');
		if($post_code==null || $post_code=='')
		{
			$this->session->set_flashdata('error', 'Oops Sorry!. invalid post code Please contact admin');				
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
		else
		{
			$all_run_day=$this->common->ex_query("select * from tbl_zipcode where zipcode ='$post_code'");
			if($all_run_day['res'])
			{
			$this->session->set_userdata('run_post_code',$post_code);
			print_r(json_encode(array('res'=>true,'msg'=>"Congrats!! We deliver to your area with Free Delivery! subject to minimum spend of $40.")));
			}
			else
			{	
			print_r(json_encode(array('res'=>false,'msg'=>"We currently don't have free delivery to your area, however, please click on live chat to discuss delivery fee and options, or send us an enquiry to find out delivery options and fees here")));
			
				
			}
		}
	}
	
	function get_post_code_of_run_helper($post_code,$order_id=null,$customer_id=null)
	{		
		$cur_date=date('Y-m-d',date(strtotime("+1 day", strtotime(date('Y-m-d')))));
		$comment1=array('table'=>'tbl_run_detail as trd',
						'val'=>'*,trd.run_date,trd.id as run_detail_id
						,(SELECT `name` FROM `tbl_working_shift` WHERE id=trd.shift) as shift_name 
						',
						//,	(SELECT count(*) FROM `tbl_recurring_order` WHERE `order_id`='.$order_id.' AND  `customer_id`='.$customer_id.' AND `run_detail_id`=trd.id ) as recorder_exists
						'where'=>array('trd.deleted'=>'0','trd.status'=>'1','trz.zip_code'=>$post_code),
						//,'trd.id'=>'76' ,'trd.run_date'=>'2018-01-01'
						//'trz.max_deliveries < trz.total_deliveries'
						'minvalue'=>'',
						//'group_by'=>'trd.id',
						'group_by'=>'trd.run_date,trd.shift',
						'start'=>'',
						'orderby'=>'trd.run_date',
						'orderas'=>'ASC');	
				$multijoin1=array(
					array('table'=>'tbl_run_zip as trz','on'=>'trz.run_id=trd.tbl_run_id AND trz.status=1','join_type'=>'left')           
					);
		
		if(date('H')>='15:00')
		{
			$this->db->where('trd.run_date>',date('Y-m-d',date(strtotime("+1 day", strtotime($cur_date)))));
		}
		else
		{
			$this->db->where('trd.run_date>',$cur_date);
		}
		$all_run_day=$this->common->multijoin($comment1,$multijoin1);
		
		/*echo '<pre>';
		print_r($all_run_day);
		exit;*/
		$res='';
		$res2='';
		$res3=array();
		$res4=array();
		$years_ar=array();
		$months_ar=array();
		$days_ar=array();
		$events_ar=array();
		$years='';
		$months='';
		$days='';
		$events='';
		
		/*$years_ct=0;
		$months_ct=0;
		$days_ct=0;
		$events_ct=0;*/
		//echo date("j",strtotime('2017-01-05'));
		$eee='';
		if($all_run_day['res'])
		{			
			foreach($all_run_day['rows'] as  $rn)
			{
				$eee[date('Y',strtotime($rn->run_date))]
					[date('n',strtotime($rn->run_date))]
					[date("j",strtotime($rn->run_date))]
												 [$rn->shift_name]=array('shift'=>$rn->shift_name,
																		   'run_detail_id'=>$rn->run_detail_id,
																		   'run_day'=>$rn->run_day,
																		   'run_date'=>$rn->run_date,
																		   'startTime'=>'',
																		   'endTime'=>'',
																		   'mTime'=>$rn->shift_name,
																		   'text'=>'<span id="selected_run_'.$rn->run_detail_id.'" style="cursor:pointer;" onclick="add_run_in_session('.$rn->run_detail_id.')">Click here to select your run <br>run id  :- '.$rn->run_counter_id.' - '.$rn->shift_name.'</span>');
			}			
		}		
		/*print_r(json_encode($eee));
		exit;*/
		//return $eee;
		$years_ct=0;
		
		//echo count($eee);
		if(is_array($eee))
		{
			//array_push($res3,'years');
			foreach($eee as $ykey=>$yval)
			{
				//echo $ykey;
				//print_r($yval);
				//exit;
				//array_push($res3['years'],array('int'=>$ykey));
				if(count($eee)>1)
				{
					//array_push($res2['years'],array('int'=>$ykey));
					$res2['years'][]=array('int'=>$ykey);
				}
				else
				{
					$res2['years']=array('int'=>$ykey);
				}
				$res3['years'][$years_ct]=array('int'=>$ykey);;
				if(is_array($yval))
				{
					$months_ct=0;
		
					//array_push($res3['years'],'months');
					foreach($yval as $mkey=>$mval)
					{
						//array_push($res3['years']['months'],array('int'=>$mkey));
						if(count($yval)>1)
						{
							//array_push($res2['years']['months'],array('int'=>$mkey));
							$res2['years']['months'][]=array('int'=>$mkey);
						}
						else
						{
							$res2['years']['months']=array('int'=>$mkey);
						}
						//array_push($res3['years'][$years_ct]['months'][$months_ct],array('int'=>$mkey));
						$res3['years'][$years_ct]['months'][$months_ct]=array('int'=>$mkey);
						//$res3[$years_ct]['months']=array('int'=>$mkey);
						if(is_array($mval))
						{
							$days_ct=0;
		
							foreach($mval as $dkey=>$dval)
							{
								if(count($mval)>1)
								{
									//array_push($res2['years']['months']['days'],array('int'=>$dkey));
									$res2['years']['months'][$months_ct]['days'][$days_ct]=array('int'=>$dkey);
								}
								else
								{
									$res2['years']['months'][$months_ct]['days']=array('int'=>$dkey);
								}
								//continue;
								$res3['years'][$years_ct]['months'][$months_ct]['days'][$days_ct]=array('int'=>$dkey);
								if(is_array($dval))
								{
									$events_ct=0;
									$rrr=array();
									foreach($dval as $ekey=>$eval)
									{
										/*echo '<pre>';
										print_r( $dval);
										print_r($eval);*/
										//exit;	
										$res3['years'][$years_ct]['months'][$months_ct]['days'][$days_ct]['events'][]=$eval;
										//$res4['years'][$years_ct]=array('int'=>$ykey,'months'=>array('int'))[$months_ct]['days'][$days_ct]['events'][]=$eval;	
										//$rrr[$ekey]=$eval;
										array_push(	$rrr[$ekey],$eval);	
										$res2['years']['months'][$months_ct]['days'][$days_ct]['events'][$ekey]=$eval;
										
										/*if(count($dval)>1)
										{
											
											foreach($eval as $eskey=>$esval)
											{
												$res2['years']['months'][$months_ct]['days'][$days_ct]['events'][$eskey]=$esval;
											}
											
										}
										else
										{
											$res2['years']['months'][$months_ct]['days'][$days_ct]['events']=array($ekey=>$eval);
										}*/
										/*if(count($eval)>1)
										{
											foreach($eval as $eskey=>$esval)
											{
												$res2['years']['months'][$months_ct]['days'][$days_ct]['events'][$eskey]=$esval;
											}
										}
										else
										{
											$res2['years']['months'][$months_ct]['days'][$days_ct]['events']=$eval;
										}*/
										$events_ct++;
									}
									//$res3['years'][$years_ct]['months'][$months_ct]['days'][$days_ct]['events']=$rrr;					
								}
								$days_ct++;
							}
						}
						$months_ct++;
					}
				}
				$years_ct++;
			}
		}
		//echo '<pre>';
		print_r(json_encode($res3));
		
	}
	
}