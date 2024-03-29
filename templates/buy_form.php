<div id="pill-bar">
    <ul><li id="buy" class="active"><a href="/buy.php">Buy</a></li><li id="sell" class="inactive"><a href="/sell.php">Sell</a></li></ul>
</div>
<div id="pill-content">
    


<style>

.invisible {
    display:none;
}

.cf:before, .cf:after{
    content:"";
    display:table;
}
 
.cf:after{
    clear:both;
}
 
.cf{
    zoom:1;
} 

/* Form wrapper styling */
.form-wrapper {
    width: 45%;
    height: 40px;
    padding: .9% .9% .9% .9%;
    background: #444;
    background: rgba(0,0,0,.2);
    display: inline-block;
    vertical-align:top;
    margin-left:2%;
    text-align:center;
    border-radius: 10px;
    box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
}
 
/* Form text input */
 
.form-wrapper input {
    width: 83.2%;
    height: 20px;
    padding: 10px 5px;
    float: left;   
    font: bold 15px 'lucida sans', 'trebuchet MS', 'Tahoma';
    border: 0;
    background: #eee;
    border-radius: 3px 0 0 3px;     
}
 
.form-wrapper input:focus {
    outline: 0;
    background: #fff;
    box-shadow: 0 0 2px rgba(0,0,0,.8) inset;
}
 
.form-wrapper input::-webkit-input-placeholder {
   color: #999;
   font-weight: normal;
   font-style: italic;
}
 
.form-wrapper input:-moz-placeholder {
    color: #999;
    font-weight: normal;
    font-style: italic;
}
 
.form-wrapper input:-ms-input-placeholder {
    color: #999;
    font-weight: normal;
    font-style: italic;
}   
 
/* Form submit button */
.form-wrapper button {
    overflow: visible;
    position: absolute;
    left: 38.5%;
    float: right;
    border: 0;
    padding: 0;
    cursor: pointer;
    height: 40px;
    width: 10%;
    font: bold 60%/40px 'lucida sans', 'trebuchet MS', 'Tahoma';
    color: #fff;
    text-transform: uppercase;
    background: #680000;
    border-radius: 0 3px 3px 0;     
    text-shadow: 0 -1px 0 rgba(0, 0 ,0, .3);
}  
   
.form-wrapper button:hover{    
    background: #530000;
}  
   
.form-wrapper button:active,
.form-wrapper button:focus{  
    background: #c42f2f;
    outline: 0;  
}
 
.form-wrapper button:before { /* left arrow */
    content: '';
    position: absolute;
    border-width: 8px 8px 8px 0;
    border-style: solid solid solid none;
    border-color: transparent #680000 transparent;
    top: 12px;
    left: -6px;
}
 
.form-wrapper button:hover:before{
    border-right-color: #530000;
}
 
.form-wrapper button:focus:before,
.form-wrapper button:active:before{
        border-right-color: #c42f2f;
}     
 
.form-wrapper button::-moz-focus-inner { /* remove extra button spacing for Mozilla Firefox */
    border: 0;
    padding: 0;
}

.title{
    text-align:center;
    font-size:40px;
    padding:20px;
    color: #9C9B9B;
    text-shadow: 2px 2px 5px black;
}

</style>
        <fieldset>
            <div class="form-wrapper cf">
                <input type="text" id="booksearch" placeholder="Find your Book by Author, Title, or ISBN">
                <button type="submit">Search</button>
            </div>
            <div class="form-wrapper cf">
                <h4>Class filters coming soon!</h4>
            </div> 
        </fieldset>
        <br>
        <div id="resultstable">

        </div>
</div>

