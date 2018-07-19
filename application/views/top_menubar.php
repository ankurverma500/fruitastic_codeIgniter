<div id="bottom_navbar">
     <div class="container"> 
      <!--<div class="row">-->  
       <nav class="navbar navbar-inverse" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
        </div>
        <div class="navbar-collapse collapse" id="myNavbar" aria-expanded="false" style="height: 1px;">
          <ul class="nav navbar-nav shop_no_menu">
          <?php
          $da=array('val'=>'`id`, `name`, `status`, `deleted`, `added_date`, `orderby`, `class`',
					  'table'=>'tbl_category',
					  'where'=>array('status'=>'1','deleted'=>'0'));
			$this->db->order_by('orderby','DESC');
			$category=$this->common->getdata($da);
			if($category['res'])
			{
				foreach($category['rows'] as $ct)
				{
					$active='';
					if($cat_id==$ct->id){$active='class="active"';}
					echo '<li '.$active.'><a href="'.base_url('product/index/'.$ct->id).'">'.$ct->name.' </a></li>';
				}
			}
		  ?>
            <?php /*?><li><a href="product.html">Fruits </a></li>
            <li><a href="product.html" class="dropdown-toggle">Vegetables </a></li>
            <li><a href="product.html">Seasonal Boxes </a></li>
            <li><a href="product.html">Beverages </a></li>
            <li><a href="product.html">Essentials Oils Other</a></li>
            <li class="hidden-lg hidden-md hidden-sm"><a href="product.html" class="mdllink">Groceries</a></li>
            <li class="hidden-lg hidden-md hidden-sm"><a href="product.html" class="mdllink">Offers </a></li>
            <li class="hidden-lg hidden-md hidden-sm"><a href="product.html" class="mdllink">Summer Specials</a></li>
            <li><a href="product.html">Other</a></li><?php */?>
          </ul>
        </div>
       </nav>
      <!--</div>-->
     </div>
    </div>
