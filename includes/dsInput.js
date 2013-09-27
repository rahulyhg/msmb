/**
* Date Selector Input
*
* An intelligent set of 3 combo boxes for entering dates.
* The boxes update according to which day/month/year has been selected
* to account for days in each month (including leap years).
*
* @author Kevin Southworth <southwo8@msu.edu>
* @link http://kevin.tridubdesign.com
* @modified 2004-04-06
* @version 0.2
*/

/**
* The date selector constructor
*
* @access public
* @param string objName      Name of the object that you create
* @param string formName	Name of the form this object is in (OPTIONAL)
*/

try {
function dsInput( objName, formName ) {
	
	/* Properties */
	this.objName 		= objName;
	this.today          = new Date();
	this.date           = this.today.getDate();
	this.month          = this.today.getMonth()+1;
	this.year           = this.today.getFullYear();
	if(this.year < 2000) this.year += 1900; //for Netscape
	//added
	this.yearComboRange = 60;
	//this.yearComboRange = 5;
	//added
	this.yearComboRange1 = 18;
		
	this.formName 		= arguments[1] ? arguments[1] : 'none';
	this.dayObj			= '';
	this.monthObj		= '';
	this.yearObj		= '';
	this.monthNames		= new Array( '','January','February','March','April','May','June','July','August','September','October','November','December' );
	
	
	/* Public Methods */
	this.setToToday			= ds_setToToday;
	this.adjustDaysInMonth 	= ds_adjustDaysInMonth;
	this.setDate			= ds_setDate;
	this.setDateParts		= ds_setDateParts;
	this.getSelYear			= ds_getYear;
	this.getSelMonth		= ds_getMonth;
	this.getSelDay			= ds_getDay;

	/* Private Methods */
	this._initOptions		= ds_initOptions;
	this._writeYearOptions 	= ds_writeYearOptions;
	this._writeMonthOptions = ds_writeMonthOptions;
	this._writeDayOptions 	= ds_writeDayOptions;
	this._getDaysInMonth	= ds_getDaysInMonth;
	
	/* Constructor Code */
	if( this.formName == 'none' ) {
		this.dayObj = eval("document.forms[0]." + this.objName + "D");
		this.monthObj = eval("document.forms[0]." + this.objName + "M");
		this.yearObj = eval("document.forms[0]." + this.objName + "Y");
	} else {
		this.dayObj = eval("document." + this.formName + "." + this.objName + "D");
		this.monthObj = eval("document." + this.formName + "." + this.objName + "M");
		this.yearObj = eval("document." + this.formName + "." + this.objName + "Y");	
	}	
	this._initOptions();
	this.setToToday();
	this.adjustDaysInMonth();	
}

/* Class Methods */

/**
* Set the date boxes to today's date
*/
function ds_setToToday() {
	this.setDateParts( this.year, this.month, this.date );
}
/**
* Set the date boxes to specific date
* @param string dateStr 'YYYYMMDD'
*/
function ds_setDate( dateStr ) {
	var y, m, d;
	y = dateStr.substr(0,4);
	m = dateStr.substr(4,2);
	d = dateStr.substr(6,2);
	this.setDateParts( y, m, d );
}
/**
* Set the date boxes to today's date
* @param integer year
* @param integer month
* @param integer day
*/
function ds_setDateParts( year, month, date ) {
	this.dayObj[date-1].selected = true;
	this.monthObj[month-1].selected = true;
	for( i=0; i < this.yearObj.length; i++ ) {
		if( this.yearObj[i].value == year )
			this.yearObj[i].selected = true;
	}
	this.adjustDaysInMonth();
}


function ds_getYear() {
	return this.yearObj[this.yearObj.selectedIndex].value;
}

function ds_getMonth() {
	return this.monthObj[this.monthObj.selectedIndex].value;
}

function ds_getDay() {
	return this.dayObj[this.dayObj.selectedIndex].value;
}

/**
* Adjust the 'days' box according to the
* current month and year
*/
function ds_adjustDaysInMonth() {
	Month = this.monthObj[this.monthObj.selectedIndex].value;
	//alert( Month );
	Year = this.yearObj[this.yearObj.selectedIndex].value;
	//alert( Year);
	
	DaysForThisSelection = this._getDaysInMonth(Month, Year);
	PrevDaysInSelection = this.dayObj.length;
	
	if (PrevDaysInSelection > DaysForThisSelection) {
		for (i=0; i<(PrevDaysInSelection-DaysForThisSelection); i++) {
			this.dayObj.options[this.dayObj.options.length - 1] = null;
		}
	}
	if (DaysForThisSelection > PrevDaysInSelection) {
		var prevLastDay = this.dayObj.options.length;
		for( i = prevLastDay+1; i <= DaysForThisSelection; i++ ) {
			var newOption = new Option( i, i );
			var optionsColl = this.dayObj.options;
			optionsColl[optionsColl.length] = newOption;
		}
	}
	if (this.dayObj.selectedIndex < 0)
		this.dayObj.selectedIndex == 0;
}

/* Private Methods */

function ds_initOptions() {
	this._writeYearOptions();
	this._writeMonthOptions();
	this._writeDayOptions();
}

function ds_getDaysInMonth( m, y ) {
	monthdays = [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
	if (m != 2) {
		return monthdays[m];
	} else {
		return ((y % 4 == 0 && y % 100 != 0) || y % 400 == 0 ? 29 : 28);
	}
}

function ds_writeYearOptions() {
	for( i=(this.year-this.yearComboRange); i<=(this.year-this.yearComboRange1); i++ ) {
		var newOption = new Option( i, i );
		var optionsColl = this.yearObj.options;
		optionsColl[optionsColl.length] = newOption;
	}
}

function ds_writeMonthOptions() {
	for( i=1; i <= 12; i++ ) {
		var newOption = new Option( this.monthNames[i], i );
		var optionsColl = this.monthObj.options;
		optionsColl[optionsColl.length] = newOption;
	}
}

function ds_writeDayOptions() {
	for( i=1; i <= 31; i++ ) {
		var newOption = new Option( i, i );
		var optionsColl = this.dayObj.options;
		optionsColl[optionsColl.length] = newOption;
	}
}
} catch (e) {
	
}