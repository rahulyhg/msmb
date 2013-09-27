<?
include("../includes/lib.php");
$dat=$_GET['dat'];
 $select_lon="select longitude_deg,latitude_deg,time_zone,long_dir,lat_dir,longitude_min,latitude_min from citydata where place_name='$dat'";
 $result_lon=mysql_query($select_lon,$link);
 if($lon=mysql_fetch_array($result_lon)){
 $longi=$lon[0];
 $longi_m=$lon[5];
 $lati=$lon[1];
 $lati_m=$lon[6];
 $t_zone=$lon[2];
 $longi_d=$lon[3];
 $lati_d=$lon[4];
 }
?>
<input name="longi" type="hidden" value="<? echo $longi;?>" />
<input name="longi_m" type="hidden" value="<? echo $longi_m;?>" />
<input name="lati" type="hidden" value="<? echo $lati;?>" />
<input name="lati_m" type="hidden" value="<? echo $lati_m;?>" />
<input name="longi_d" type="hidden" value="<? echo $longi_d;?>" />
<input name="lati_d" type="hidden" value="<? echo $lati_d;?>" />
<input name="t_zone" type="hidden" value="<? echo $t_zone;?>" />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr>
                  <td width="168" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr>
                      <td width="90" height="20" valign="top" class="menup"><strong>LONG:</strong></td>
                            <td width="78" valign="top" class="menup"><? echo $longi.".".$longi_m; ?></td>
                            </tr>
                    </table>                  </td>
                      </tr>
                <tr>
                  <td height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="90" height="20" valign="top" class="menup"><strong>LAT:</strong></td>
                              <td width="78" valign="top" class="menup"><? echo $lati.".".$lati_m; ?></td>
                            </tr>
                          </table></td>
                      </tr>
                <tr>
                  <td height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="90" height="20" valign="top" class="menup"><strong>LONG DIR:</strong></td>
                              <td width="78" valign="top" class="menup"><? echo $longi_d; ?></td>
                            </tr>
                          </table></td>
                      </tr>
                <tr>
                  <td height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="90" height="20" valign="top" class="menup"><strong>LAT DIR:</strong></td>
                              <td width="78" valign="top" class="menup" ><? echo $lati_d; ?></td>
                            </tr>
                          </table></td>
                      </tr>
                <tr>
                  <td height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="90" height="20" valign="top" class="menup"><strong>TIMEZONE:</strong></td>
                              <td width="78" valign="top" class="menup"><? echo $t_zone; ?></td>
                            </tr>
                          </table></td>
                      </tr>
                <tr>
                  <td height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="90" height="20" valign="top" class="menup"><strong>TZONE DIR:</strong></td>
                              <td width="78" valign="top" class="menup"><? echo $longi_d; ?></td>
                            </tr>
                          </table></td>
                      </tr>
                
                
                
                
                
                
              </table>