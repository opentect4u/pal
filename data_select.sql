/*************ML Out ***************************/
insert into td_leave_balance
select approval_dt,trans_cd,'A',emp_code,trans_dt,recommend_dt,
0,0,0,from_dt,to_dt,amount,0,remarks,0,0,0,0,0
from td_leaves_trans
where trans_dt >= '2019-07-03'
and   approval_status = 1
and   leave_type = 'M'

//HM out

insert into td_leave_balance
select approval_dt,trans_cd,'A',emp_code,trans_dt,recommend_dt,
0,0,0,from_dt,to_dt,amount,0,remarks,0,0,0,0,0
from td_leaves_trans
where trans_dt >= '2019-07-03'
and   approval_status = 1
and   leave_type = 'HM'

//EL out

insert into td_leave_balance
select approval_dt,trans_cd,'A',emp_code,trans_dt,recommend_dt,
0,0,0,from_dt,to_dt,0,amount,remarks,0,0,0,0,0
from td_leaves_trans
where trans_dt >= '2019-07-03'
and   approval_status = 1
and   leave_type = 'E'

//HE out

insert into td_leave_balance
select approval_dt,trans_cd,'A',emp_code,trans_dt,recommend_dt,
0,0,0,from_dt,to_dt,0,amount,remarks,0,0,0,0,0
from td_leaves_trans
where trans_dt >= '2019-07-03'
and   approval_status = 1
and   leave_type = 'HE'

//C out

insert into td_leave_balance
select approval_dt,trans_cd,'A',emp_code,trans_dt,recommend_dt,
0,0,0,from_dt,to_dt,0,0,remarks,amount,0,0,0,0
from td_leaves_trans
where trans_dt >= '2019-07-03'
and   approval_status = 1
and   leave_type = 'C'

//HC out

insert into td_leave_balance
select approval_dt,trans_cd,'A',emp_code,trans_dt,recommend_dt,
0,0,0,from_dt,to_dt,0,0,remarks,amount,0,0,0,0
from td_leaves_trans
where trans_dt >= '2019-07-03'
and   approval_status = 1
and   leave_type = 'HC'

//N out

insert into td_leave_balance
select approval_dt,trans_cd,'A',emp_code,trans_dt,recommend_dt,
0,0,0,from_dt,to_dt,0,0,remarks,0,amount,0,0,0
from td_leaves_trans
where trans_dt >= '2019-07-03'
and   approval_status = 1
and   leave_type = 'N'

//HN out

insert into td_leave_balance
select approval_dt,trans_cd,'A',emp_code,trans_dt,recommend_dt,
0,0,0,from_dt,to_dt,0,0,remarks,0,amount,0,0,0
from td_leaves_trans
where trans_dt >= '2019-07-03'
and   approval_status = 1
and   leave_type = 'HN'

//Cin

insert into td_leave_balance
select approval_dt,trans_cd,'A',emp_code,trans_dt,recommend_dt,
0,0,amount,from_dt,to_dt,0,0,remarks,0,0,0,0,0
from td_comp_apply
where trans_dt >= '2019-07-03'
and   approval_status = 1;

//Trigger

BEGIN
	 
     DECLARE	ld_c_bal		decimal(10,2);
     DECLARE	ld_m_bal		decimal(10,2);
     DECLARE	ld_e_bal		decimal(10,2);
    
     DECLARE	ld_trans_cd		Integer;
     DECLARE	ldt_bal_dt	    date;
     
     DECLARE	ldt_trans_dt	date;
     DECLARE	ld_trans_cd1		integer;
     DECLARE	ls_emp_code		varchar(30);
     
  
If old.status = 'U' And new.status = 'A' Then  

	  select max(balance_dt)
      into   ldt_bal_dt
      from   td_leave_balance1
      where  emp_code     = new.emp_code
      and    balance_dt < new.balance_dt;
      
      select max(trans_cd)
      into   ld_trans_cd
      from   td_leave_balance1
      where  emp_code     = new.emp_code
      and    balance_dt = ldt_bal_dt;
      
      SET ld_c_bal = 0;
      SET ld_m_bal = 0;
      SET ld_e_bal = 0;
      
      
      select comp_off_bal,
      	     ml_bal,
             el_bal
      into   ld_c_bal,
             ld_m_bal,
             ld_e_bal
      from   td_leave_balance1
      where  emp_code     = new.emp_code
      and    balance_dt = ldt_bal_dt
      and    trans_cd   = ld_trans_cd;
      
      
      if new.comp_off_in > 0 THEN
      	 update td_leave_balance1
         set    comp_off_bal = ld_c_bal + new.comp_off_in,
         		ml_bal       = ld_m_bal,
                el_bal       = ld_e_bal
         where  emp_code     = new.emp_code
         and    balance_dt = new.balance_dt
         and    trans_cd   = new.trans_cd;
     end if;
     
     if new.ml_out > 0 THEN
      	 update td_leave_balance1
         set    ml_bal = ld_m_bal - new.ml_out,
         		comp_off_bal = ld_c_bal,
                el_bal       = ld_e_bal
         where  emp_code     = new.emp_code
         and    balance_dt = new.balance_dt
         and    trans_cd   = new.trans_cd;
     end if;
     
     if new.el_out > 0 THEN
      	 update td_leave_balance1
         set    el_bal = ld_e_bal - new.el_out,
         		comp_off_bal = ld_c_bal,
                ml_bal    = ld_m_bal
         where  emp_code     = new.emp_code
         and    balance_dt = new.balance_dt
         and    trans_cd   = new.trans_cd;
     end if;
     
     if new.comp_off_out > 0 THEN
      	 update td_leave_balance1
         set    comp_off_bal = ld_c_bal - new.comp_off_out,
                el_bal = ld_e_bal,
                ml_bal    = ld_m_bal
         where  emp_code     = new.emp_code
         and    balance_dt = new.balance_dt
         and    trans_cd   = new.trans_cd;
     end if;
     
   
end if;   	
          
end