/**
* Template Name: NiceAdmin - v2.2.2
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  //format uang rupiah
  

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Sidebar toggle
   */
  if (select('.toggle-sidebar-btn')) {
    on('click', '.toggle-sidebar-btn', function(e) {
      select('body').classList.toggle('toggle-sidebar')
    })
  }

  /**
   * Search bar toggle
   */
  if (select('.search-bar-toggle')) {
    on('click', '.search-bar-toggle', function(e) {
      select('.search-bar').classList.toggle('search-bar-show')
    })
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Initiate tooltips
   */
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

  /**
   * Initiate quill editors
   */
  if (select('.quill-editor-default')) {
    new Quill('.quill-editor-default', {
      theme: 'snow'
    });
  }

  if (select('.quill-editor-bubble')) {
    new Quill('.quill-editor-bubble', {
      theme: 'bubble'
    });
  }

  if (select('.quill-editor-full')) {
    new Quill(".quill-editor-full", {
      modules: {
        toolbar: [
          [{
            font: []
          }, {
            size: []
          }],
          ["bold", "italic", "underline", "strike"],
          [{
              color: []
            },
            {
              background: []
            }
          ],
          [{
              script: "super"
            },
            {
              script: "sub"
            }
          ],
          [{
              list: "ordered"
            },
            {
              list: "bullet"
            },
            {
              indent: "-1"
            },
            {
              indent: "+1"
            }
          ],
          ["direction", {
            align: []
          }],
          ["link", "image", "video"],
          ["clean"]
        ]
      },
      theme: "snow"
    });
  }

  /**
   * Initiate TinyMCE Editor
   */

  var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

  tinymce.init({
    selector: 'textarea.tinymce-editor',
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    link_list: [{
        title: 'My page 1',
        value: 'https://www.tiny.cloud'
      },
      {
        title: 'My page 2',
        value: 'http://www.moxiecode.com'
      }
    ],
    image_list: [{
        title: 'My page 1',
        value: 'https://www.tiny.cloud'
      },
      {
        title: 'My page 2',
        value: 'http://www.moxiecode.com'
      }
    ],
    image_class_list: [{
        title: 'None',
        value: ''
      },
      {
        title: 'Some class',
        value: 'class-name'
      }
    ],
    importcss_append: true,
    file_picker_callback: function(callback, value, meta) {
      /* Provide file and text for the link dialog */
      if (meta.filetype === 'file') {
        callback('https://www.google.com/logos/google.jpg', {
          text: 'My text'
        });
      }

      /* Provide image and alt text for the image dialog */
      if (meta.filetype === 'image') {
        callback('https://www.google.com/logos/google.jpg', {
          alt: 'My alt text'
        });
      }

      /* Provide alternative source and posted for the media dialog */
      if (meta.filetype === 'media') {
        callback('movie.mp4', {
          source2: 'alt.ogg',
          poster: 'https://www.google.com/logos/google.jpg'
        });
      }
    },
    templates: [{
        title: 'New Table',
        description: 'creates a new table',
        content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
      },
      {
        title: 'Starting my story',
        description: 'A cure for writers block',
        content: 'Once upon a time...'
      },
      {
        title: 'New list with dates',
        description: 'New List with dates',
        content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
      }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link image imagetools table',
    skin: useDarkMode ? 'oxide-dark' : 'oxide',
    content_css: useDarkMode ? 'dark' : 'default',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
  });

  /**
   * Initiate Bootstrap validation check
   */
  var needsValidation = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(needsValidation)
    .forEach(function(form) {
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })

  /**
   * Initiate Datatables
   */
  const datatables = select('.datatable', true)
  datatables.forEach(datatable => {
    new simpleDatatables.DataTable(datatable);
  })

  /**
   * Autoresize echart charts
   */
  const mainContainer = select('#main');
  if (mainContainer) {
    setTimeout(() => {
      new ResizeObserver(function() {
        select('.echart', true).forEach(getEchart => {
          echarts.getInstanceByDom(getEchart).resize();
        })
      }).observe(mainContainer);
    }, 200);
  }

})();


// format rupiah
var rupiah1 = document.getElementById("rupiah1");
rupiah1.addEventListener("keyup", function(e) {
  rupiah1.value = convertRupiah(this.value);
});
rupiah1.addEventListener('keydown', function(event) {
	return isNumberKey(event);
});

var rupiah2 = document.getElementById("rupiah2");
rupiah2.addEventListener("keyup", function(e) {
  rupiah2.value = convertRupiah(this.value);
});
rupiah2.addEventListener('keydown', function(event) {
	return isNumberKey(event);
});

function convertRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split  = number_string.split(","),
    sisa   = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
}

function isNumberKey(evt) {
    key = evt.which || evt.keyCode;
	if ( 	key != 188 // Comma
		 && key != 8 // Backspace
		 && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
		 && (key < 48 || key > 57) // Non digit
		) 
	{
		evt.preventDefault();
		return;
	}
}
//  Function menampilkan Form MEMBER radio1
function ShowHideDiv() {
  var inlineRadio1 = document.getElementById("inlineRadio1");
  var inlineRadio2 = document.getElementById("inlineRadio2");
  var dvPassport = document.getElementById("dvPassport");
  var dvidmember = document.getElementById("dvidmember");
  var divcaribarang = document.getElementById("divcaribarang");
  var tombolpoinmember = document.getElementById("tombolpoinmember");
  var panelp = document.getElementById("panelpencarian");
  dvPassport.style.display = inlineRadio1.checked ? "block" : "none";
  dvidmember.style.display = inlineRadio1.checked ? "block" : "none";
  divcaribarang.style.display = inlineRadio1.checked ? "block" : "none";
  panelp.style.display = inlineRadio1.checked ? "none" : "block";
  document.getElementById("tampungidmember").value = '';
  document.getElementById("inputmember").value = '';
  var tabelkeranjang = document.getElementById("inputmember")
    
  if (inlineRadio1.checked == true) {
    tombolpoinmember.disabled = false;
    document.getElementById("tampungidmember").focus();
  }
}
//  Function menampilkan Form BARANG radio2
function ShowHideDiv2() {
  var inlineRadio2 = document.getElementById("inlineRadio2");
  var dvPassportt = document.getElementById("dvPassport");
  var dvidmember = document.getElementById("dvidmember");
  var divcaribarangg = document.getElementById("divcaribarang");
  var tampiltabelmember = document.getElementById("tabelcarimember"); 
  var panelp = document.getElementById("panelpencarian");
  var tombolpoinmember = document.getElementById("tombolpoinmember");
  divcaribarangg.style.display = inlineRadio2.checked ? "block" : "none";
  dvPassportt.style.display = inlineRadio2.checked ? "none" : "block";
  dvidmember.style.display = inlineRadio2.checked ? "none" : "block";
  tampiltabelmember.style.display = inlineRadio2.checked ? "none" : "block";
  panelp.style.display = inlineRadio2.checked ? "none" : "block";
  document.getElementById("tampungidmember").value = '999999999999999';
  document.getElementById("inputmember").value = '-';
  
  if (inlineRadio2.checked == true) {
    tombolpoinmember.disabled = true;
    document.getElementById("inputbarang").focus();
    document.getElementById("spanpoinmember").value = '-';

  }
}

// fungsi pencarian member
function searchTable() {
  var input;
  var saring;
  var status; 
  var tbody; 
  var tr; 
  var td;
  var i; 
  var j;
  input = document.getElementById("inputmember");
  var tampiltb = document.getElementById("tabelcarimember"); 
  var panel = document.getElementById("panelpencarian");
  var tabacbar = document.getElementById("tabelcaribarang");
  tabacbar.style.display = input.onkeyup? "none" : "block"; 
  tampiltb.style.display = input.onkeyup? "block" : "none";
  panel.style.display = input.onkeyup? "block" : "none";

  saring = input.value.toUpperCase();
  tbody = document.getElementsByTagName("tbody")[0];
  tr = tbody.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td"); 
      for (j = 0; j < td.length; j++) {
          if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
              status = true;
          }
      }
      if (status) {
          tr[i].style.display = "";
          status = false;
      } else {
          tr[i].style.display = "none";
      }
  }
}

function searchTableid() {
  var input;
  var saring;
  var status; 
  var tbody; 
  var tr; 
  var td;
  var i; 
  var j;
  input = document.getElementById("tampungidmember");
  var tampiltb = document.getElementById("tabelcarimember"); 
  var panel = document.getElementById("panelpencarian");
  var tabacbar = document.getElementById("tabelcaribarang");
  tabacbar.style.display = input.onkeyup? "none" : "block"; 
  tampiltb.style.display = input.onkeyup? "block" : "none";
  panel.style.display = input.onkeyup? "block" : "none";

  saring = input.value.toUpperCase();
  tbody = document.getElementsByTagName("tbody")[0];
  tr = tbody.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td"); 
      for (j = 0; j < td.length; j++) {
          if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
              status = true;
          }
      }
      if (status) {
          tr[i].style.display = "";
          status = false;
      } else {
          tr[i].style.display = "none";
      }
  }
}

// fungsi pencarian barang
function caribarang() {
  var inputb;
  var saringb;
  var statusb; 
  var tbodyb; 
  var trb; 
  var tdb;
  var ib; 
  var jb;
  inputb = document.getElementById("inputbarang");
  var tampiltb = document.getElementById("tabelcaribarang"); 
  var panel = document.getElementById("panelpencarian");
  var tacame =document.getElementById("tabelcarimember");
  
  tacame.style.display = inputb.onkeyup? "none" : "block";
  tampiltb.style.display = inputb.onkeyup? "block" : "none";
  panel.style.display = inputb.onkeyup? "block" : "none";

  saringb = inputb.value.toUpperCase();
  tbodyb = document.getElementsByClassName("tbodybarang")[0];;
  trb = tbodyb.getElementsByClassName("trbarang");
  for (ib = 0; ib < trb.length; ib++) {
      tdb = trb[ib].getElementsByClassName("tdbarang"); 
      for (jb = 0; jb < tdb.length; jb++) {
          if (tdb[jb].innerHTML.toUpperCase().indexOf(saringb) > -1) {
              statusb = true;
          }
      }
      if (statusb) {
          trb[ib].style.display = "";
          statusb = false;
      } else {
          trb[ib].style.display = "none";
      }
  }
}

var tampungpoin;
var tampungidmember;


//function pilih member
function tambahmember(){
  var tablem = document.getElementById("tabelmember"),rIndex;
  var tombolpoinmemberr = document.getElementById("tombolpoinmember");
  var ketidmember = document.getElementById("ketidmember");
  
  for (var i=0; i < tablem.rows.length; i++){
    tablem.rows[i].cells[0].onclick = function(){
      rIndex = this.parentElement.rowIndex;
      console.log(rIndex);
      var tukar = 200;
      tampungidmember = this.parentElement.cells[1];
      tampungpoin = this.parentElement.cells[3].innerHTML;
      document.getElementById("tampungidmember").value = this.parentElement.cells[1].innerHTML;
      document.getElementById("inputmember").value = this.parentElement.cells[2].innerHTML;
      document.getElementById("spanpoinmember").value = parseInt(this.parentElement.cells[3].innerHTML) + parseInt(document.getElementById("bonuspoinsaatini").value);
      document.getElementById("panelpencarian").style.display = "none";
      ketidmember.display = "block";
      if (document.getElementById("spanpoinmember").value >= '200'){
        tombolpoinmemberr.disabled = false;
      }else if (document.getElementById("spanpoinmember").value < '200'){
        tombolpoinmemberr.disabled = true;
      }
    }
  }
}



//function hitung jumlah dan poin dalam tabel keranjang
function hitungjumlahharga(){

  var cekrd1 = document.getElementById("inlineRadio1");
  var cekrd2 = document.getElementById("inlineRadio2");

  if (cekrd1.checked == true) {
    var tabelkeranjang = document.getElementById("tabelkeranjang"),getIndex;
    var tampungjumlah = document.getElementById("jumlahbeli").value;
    for (var a=1; a < tabelkeranjang.rows.length; a++){
        tabelkeranjang.rows[a].cells[5].onclick = function(){
        getIndex = this.parentElement.rowIndex;
        console.log(getIndex);
        var poin = this.parentElement.cells[3].innerHTML;
        var hargaawal = this.parentElement.cells[2].innerHTML;
        var jumlahbeli = parseInt(this.parentElement.cells[5].firstChild.value);
        var hargabarang = parseInt(this.parentElement.cells[6].innerHTML);
        
        var jumlahharga = parseInt(hargaawal) * parseInt(jumlahbeli);
        var akumulasipoin = parseInt(poin) * jumlahbeli;
        //var hitungstok = parseInt(stokbarang[a]) - jumlahbeli;
        //var jumlahharga = jumlahbeli * hargabarang;
        console.log(jumlahbeli);
        console.log(hargabarang);

        this.parentElement.cells[6].firstChild.value = jumlahharga;
        this.parentElement.cells[7].firstChild.value = akumulasipoin;
        //this.parentElement.cells[4].innerHTML = hitungstok;
        var tombolpoin = document.getElementById("tombolpoinmember");
          tombolpoin.innerHTML = 'Tukar Poin';
          tombolpoin.style.backgroundColor = '#0d6efd';
          tombolpoin.style.color = 'white';
        hitungtotalharga();
        
        
      }  
    }
  }else if (cekrd2.checked == true) {
    var tabelkeranjang = document.getElementById("tabelkeranjang"),getIndex;
    var tampungjumlah = document.getElementById("jumlahbeli").value;
    for (var a=1; a < tabelkeranjang.rows.length; a++){
        tabelkeranjang.rows[a].cells[5].onclick = function(){
        getIndex = this.parentElement.rowIndex;
        console.log(getIndex);
        var poin = this.parentElement.cells[3].innerHTML;
        var hargaawal = this.parentElement.cells[2].innerHTML;
        var jumlahbeli = parseInt(this.parentElement.cells[5].firstChild.value);
        var hargabarang = parseInt(this.parentElement.cells[6].innerHTML);
        //var hargabarang2 = hargabarang;
        
        var jumlahharga = parseInt(hargaawal) * parseInt(jumlahbeli);
        //var akumulasipoin = parseInt(poin) * jumlahbeli;
        
        //var jumlahharga = jumlahbeli * hargabarang;
        console.log(jumlahbeli);
        console.log(hargabarang);
        
        this.parentElement.cells[6].firstChild.value = jumlahharga;
        this.parentElement.cells[7].firstChild.value = '0';
        var tombolpoin = document.getElementById("tombolpoinmember");
          tombolpoin.innerHTML = 'Tukar Poin';
          tombolpoin.style.backgroundColor = '#0d6efd';
          tombolpoin.style.color = 'white';
          hitungtotalharga();
      }  
    }
  }
} 

//function delete row tabel keranjang
function hapustabelkeranjang(){
  var tabelkeranjang = document.getElementById("tabelkeranjang"),getIndex;
  
  for (var h=1 ; h < tabelkeranjang.rows.length; h++){
      tabelkeranjang.rows[h].cells[8].onclick = function(){
        getIndex = this.parentElement.rowIndex;
        tabelkeranjang.deleteRow(getIndex);
        console.log(getIndex);
        if (getIndex == '1') {
          var brgkeranjang = document.getElementById("tabelkeranjang");
          document.getElementById("barangjumlah").value = parseInt(brgkeranjang.rows.length) - 2;
          
          document.getElementById("hargatotalsaatini").value = '0';
          document.getElementById("totalbarangsaatini").value = '0';
          document.getElementById("bonuspoinsaatini").value = '0';
          document.getElementById("totalhargaatas").innerHTML = 'Total : Rp.0';
          document.getElementById("spanpoinmember").value = tampungpoin;
          
          var tombolpoin = document.getElementById("tombolpoinmember");
          tombolpoin.innerHTML = 'Tukar Poin';
          tombolpoin.style.backgroundColor = '#0d6efd';
          tombolpoin.style.color = 'white';
          document.getElementById("ketukarpoin").value ='0';
          document.getElementById("inputbayar").value='';
          document.getElementById("inputkembalian").value='';
        }
        
        var brgkeranjang = document.getElementById("tabelkeranjang");
        document.getElementById("barangjumlah").value = parseInt(brgkeranjang.rows.length) - 2;
        var tombolpoin = document.getElementById("tombolpoinmember");
          tombolpoin.innerHTML = 'Tukar Poin';
          tombolpoin.style.backgroundColor = '#0d6efd';
          tombolpoin.style.color = 'white';
          document.getElementById("ketukarpoin").value ='0';
          document.getElementById("inputbayar").value='';
          document.getElementById("inputkembalian").value='';
        hitungtotalharga();
      }
  }
}

//bismillahirrohmanirrohiim.
//la gholiba illa billah

//function hitung total harga, total barang, total poin
function hitungtotalharga(){
  var rd1 = document.getElementById("inlineRadio1");
  var rd2 = document.getElementById("inlineRadio2");
  var bacatabel = document.getElementById("tabelkeranjang");
  var hasil = 0;
  var hasilpoin = 0;
  var hasibarang = 0;
  for(var d = 1; d < bacatabel.rows.length; d++){
    
      var hrg = parseInt(bacatabel.rows[d].cells[6].firstChild.value);
      hasil = parseInt(hasil) + hrg;
      console.log(hasil);
      document.getElementById("hargatotalsaatini").value = hasil;

      var brg = parseInt(bacatabel.rows[d].cells[5].firstChild.value);
      hasibarang = parseInt(hasibarang) + brg;
      document.getElementById("totalbarangsaatini").value = hasibarang;

      if (rd1.checked == true) {
        if (document.getElementById("tampungidmember").value == '') {
          alert('Pilih Member Terlebih Dahulu');
          document.getElementById("tampungidmember").focus();
        }else if (document.getElementById("tampungidmember").value != '') {
          var akupoin = parseInt(bacatabel.rows[d].cells[7].firstChild.value);
          hasilpoin = parseInt(hasilpoin) + akupoin;
          document.getElementById("bonuspoinsaatini").value = hasilpoin;

          document.getElementById("spanpoinmember").value = parseInt(tampungpoin) + hasilpoin;
          hitungkembalian();  
        }
        
      }else{
        document.getElementById("bonuspoinsaatini").value = '0';
        hitungkembalian();  
      }
      var bilangan = hasil;
	
      var	number_string = bilangan.toString(),
        sisa 	= number_string.length % 3,
        rupiah 	= number_string.substr(0, sisa),
        ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
          
      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
      document.getElementById("totalhargaatas").innerHTML = 'Total : Rp.' + rupiah;
  }
} 

function gantimember(){
  var ketpoin = document.getElementById("")
}



function resetform() {
  var tanya = confirm("Reset Form Transaksi ?");
  if(tanya === true) {
    document.getElementById("inlineRadio1").checked = false;
    document.getElementById("inlineRadio2").checked = false;
    document.getElementById("tampungidmember").value = '';
    document.getElementById("dvidmember").style.display = 'none';
    document.getElementById("dvPassport").style.display = 'none';
    document.getElementById("inputmember").value = '';
    document.getElementById("divcaribarang").style.display = 'none';
    document.getElementById("inputbarang").value = '';
    document.getElementById("panelpencarian").style.display = 'none';
    document.getElementById("tabelcarimember").style.display = 'none';
    document.getElementById("tabelcaribarang").style.display = ' none';
    document.getElementById("totalbarangsaatini").value = '0';
    document.getElementById("totalhargaatas").innerHTML = 'Total : Rp.0';
    document.getElementById("hargatotalsaatini").value = '0';
    document.getElementById("bonuspoinsaatini").value = '0';
    document.getElementById("spanpoinmember").value = '-';
    var tombolpoin = document.getElementById("tombolpoinmember");
    tombolpoin.innerHTML = 'Tukar Poin';
    tombolpoin.style.backgroundColor = '#0d6efd';
    tombolpoin.style.color = 'white';
    document.getElementById("inputbayar").value = '';
    document.getElementById("inputkembalian").value = '';
    //document.getElementById("tabelkeranjang").innerHTML = '';
    var tabelkeranjang = document.getElementById("tabelkeranjang"),getIndex;
    document.location.href="index.php?page=transaksi";
  }else{
      
  }
}



// var tbbarang = document.getElementById("tablecaribarang");
// var btnbrg = document.getElementById("btntambahbarang");
// for(var e = 1; e < bacatabel.rows.length; e++){
//   if (tbbarang.rows[e].cells[4].innerHTML == '0') {
//     btnbrg.disabled = true;
    
//   }
// }

//function hitung total barang
// function hitungjumlahpoin(){
//   var tabelpoin = document.getElementById("tabelkeranjang");
//   var hitung = 0;
  
//     for(var k = 1; k < tabelpoin.rows.length; k++){
      
//       var hitungpoin = parseInt(tabelpoin.rows[k].cells[7].innerHTML);
//       hitung = hitungpoin + hitung;
//       console.log(hitung);
//       document.getElementById("bonuspoinsaatini").value = hitung;
//   }
  
// }


function tukarpoin(tampungpoinsudahtukar) {
  var tombolpoin = document.getElementById("tombolpoinmember");
  
  var tampungpoinsudahtukar;
  var tukarp = document.getElementById("poinminimal").innerHTML;
  var tukar = document.getElementById("hargadiskon").innerHTML;

    if (tombolpoin.innerHTML == 'Tukar Poin') {
      if (parseInt(document.getElementById("spanpoinmember").value) >= '200') {
        document.getElementById("spanpoinmember").value = parseInt(document.getElementById("spanpoinmember").value) - parseInt(tukarp);

        document.getElementById("hargatotalsaatini").value = parseInt(document.getElementById("hargatotalsaatini").value) - parseInt(tukar);
        var tot = parseInt(document.getElementById("hargatotalsaatini").value);

        formatrp(tot);
        tampungpoinsudahtukar = document.getElementById("spanpoinmember").value;
        
        tombolpoin.innerHTML = 'Batal Tukar Poin';
        tombolpoin.style.backgroundColor = '#ffc107';
        tombolpoin.style.border = 'none';
        tombolpoin.style.color = 'black';
        document.getElementById("ketukarpoin").value ='1';
        alert('Tukar Poin Berhasil');
        console.log(tukarp);
      }
        else if(parseInt(document.getElementById("spanpoinmember").value) < '200'){
          alert('Poin Tidak Cukup');
          console.log(tukarp);
          
      }
    }
    //document.getElementById("tampungpoin").value = tukarp.innerHTML;
    else if(tombolpoin.innerHTML == 'Batal Tukar Poin'){
      document.getElementById("spanpoinmember").value = parseInt(document.getElementById("spanpoinmember").value) + parseInt(tukarp);

      document.getElementById("hargatotalsaatini").value = parseInt(document.getElementById("hargatotalsaatini").value) + parseInt(tukar);
      var tot = parseInt(document.getElementById("hargatotalsaatini").value);
      formatrp(tot);

      tombolpoin.innerHTML = 'Tukar Poin';
      tombolpoin.style.backgroundColor = '#0d6efd';
      tombolpoin.style.color = 'white';
      document.getElementById("ketukarpoin").value ='0';
      alert('Tukar Poin Dibatalkan');
      
    }
  }
  

function formatrp(hasil){
  var bilangan = hasil;

  var	number_string = bilangan.toString(),
    sisa 	= number_string.length % 3,
    rupiah 	= number_string.substr(0, sisa),
    ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
      
  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }
  document.getElementById("totalhargaatas").innerHTML = 'Total : Rp.' + rupiah;
}

//function pilih barang
function tambahbarang(){
  var tableb = document.getElementById("tablecaribarang"),rIndex;
  var tombolpoinmemberr = document.getElementById("tombolpoinmember");
  
  for (var i=0; i < tableb.rows.length; i++){
    tableb.rows[i].cells[0].onclick = function(){
      rIndex = this.parentElement.rowIndex;
      console.log(rIndex);
      document.getElementById("panelpencarian").style.display = "none";
      var list1 = [];//id
      var list2 = [];//kode
      var list3 = [];//nama
      var list4 = [];//stok
      var list5 = [];//harga member
      var list6 = [];//harga normal
      var list7 = [];//poin
      var listharga = [];
      var listjumlah = [];
      var hitungpoin = [];
      var listhapus = [];
      
      
      var n = 1;
      var x = 0;

      var cekrd1 = document.getElementById("inlineRadio1");
      var cekrd2 = document.getElementById("inlineRadio2");

      if (cekrd1.checked == true) {
        if (document.getElementById("tampungidmember").value == '') {
          alert('Pilih Member Terlebih Dahulu');
          document.getElementById("tampungidmember").focus();
        }else if(document.getElementById("tampungidmember").value != ''){

          var addRown = document.getElementById("tabelkeranjang");
          var newRow = addRown.insertRow(n);

          list1[x] = "<input type='hidden' id='kerhargabrg' name='idbarang[]' value='"+this.parentElement.cells[1].innerHTML+"'>"+this.parentElement.cells[1].innerHTML+"";//id
          list2[x] = "<input type='hidden' id='kerkodebarang' name='kodebarang[]' value='"+this.parentElement.cells[2].innerHTML+"'>"+this.parentElement.cells[2].innerHTML+"";//kode
          list3[x] = "<input type='hidden' id='kernamabarang' name='namabarang[]' value='"+this.parentElement.cells[3].innerHTML+"'>"+this.parentElement.cells[3].innerHTML+"";//nama
          list4[x] = "<input type='text' id='stokbrg' name='stokbrg[]' value='"+this.parentElement.cells[4].innerHTML+"' class='form-control'  style='background-color: transparent; border:none' readonly>"
          list5[x] = "<td align='left' valign='middle'>"+this.parentElement.cells[5].innerHTML+"</td>";//harga member
          list6[x] = this.parentElement.cells[6].innerHTML;//harga normal
          list7[x] = this.parentElement.cells[7].innerHTML;//poin
          listharga[x] = "<input type='text' id='kerhargabrg' name='hargabrg[]' value='0' class='form-control'  style='background-color: transparent; border:none' readonly>"
          listjumlah[x] = "<input id='jumlahbeli' name='jumlahbeli[]' onchange='hitungtotalharga();' onclick='hitungjumlahharga(); hitungjumlahpoin();' class='form-control' min='1' type='number' value='0'>"; //jumlah
          hitungpoin[x] = "<input type='text' id='hitungpoin' name='hitungpoin[]' value='0' class='form-control'  style='background-color: transparent; border:none' readonly>"; //hitung poin
          listhapus[x] = "<button type='button' id='tombolhapusbrg' onclick='hapustabelkeranjang();' class='btn btn-danger btn-sm'><span class='bi bi-trash'></span></button>";
          
          //var tr = document.createElement('tr');

          // var cel1 = tr.appendChild(document.createElement('td'));
          // var cel2 = tr.appendChild(document.createElement('td'));
          // var cel3 = tr.appendChild(document.createElement('td'));
          // var cel4 = tr.appendChild(document.createElement('td'));
          // var cel5 = tr.appendChild(document.createElement('td'));
          // var cel6 = tr.appendChild(document.createElement('td'));
          // var cel7 = tr.appendChild(document.createElement('td'));
          // var cel8 = tr.appendChild(document.createElement('td'));
          // var cel9 = tr.appendChild(document.createElement('td'));

          // cel1.innerHTML = '<td>'+list1[x]+'</td>'; //id
          // cel2.innerHTML = '<td>'+list3[x]+'</td>'; //nama
          // cel3.innerHTML = '<td>'+list5[x]+'</td>'; //harga satuan
          // cel4.innerHTML = '<td>'+list7[x]+'</td>'; //poin
          // cel5.innerHTML = '<td>'+list4[x]+'</td>'; //stok
          // cel6.innerHTML = '<td>'+listjumlah[x]+'</td>'; //jumlah
          // cel7.innerHTML = '<td>0</td>'; //akumulasiharga
          // cel8.innerHTML = '<td>0</td>'; //akumulasi poin
          // cel9.innerHTML = '<td>'+listhapus[x]+'</td>'; //tombolhapus

          // document.getElementById("tabelkeranjang").appendChild(tr);

          var cel1 = newRow.insertCell(0);//id
          var cel2 = newRow.insertCell(1);//nama
          var cel3 = newRow.insertCell(2);//harga satuan
          var cel4 = newRow.insertCell(3);//poin
          var cel5 = newRow.insertCell(4);//stok
          var cel6 = newRow.insertCell(5);//jumlah
          var cel7 = newRow.insertCell(6);//akumulasi harga
          var cel8 = newRow.insertCell(7);//poin
          var cel9 = newRow.insertCell(8);//hapus

          cel1.innerHTML = list1[x]; //id
          cel2.innerHTML = list3[x]; //nama
          cel3.innerHTML = list5[x]; //harga satuan
          cel4.innerHTML = '<td>'+list7[x]+'</td>'; //poin
          cel5.innerHTML = list4[x]; //stok
          cel6.innerHTML = '<td>'+listjumlah[x]+'</td>'; //jumlah
          cel7.innerHTML = listharga[x];//akumulasiharga
          cel8.innerHTML = hitungpoin[x]; //akumulasi poin
          cel9.innerHTML = '<td>'+listhapus[x]+'</td>'; //tombolhapus
          
          totalbrg();
          console.log(totalbrg());
        } 
      }
      else if (cekrd2.checked == true) {
         
        var addRown = document.getElementById("tabelkeranjang");
          var newRow = addRown.insertRow(n);

          list1[x] = list1[x] = "<input type='hidden' id='kerhargabrg' name='idbarang[]' value='"+this.parentElement.cells[1].innerHTML+"'>"+this.parentElement.cells[1].innerHTML+"";//id
          list2[x] = this.parentElement.cells[2].innerHTML;//kode
          list3[x] = this.parentElement.cells[3].innerHTML;//nama
          list4[x] = "<input type='text' id='stokbrg' name='stokbrg[]' value='"+this.parentElement.cells[4].innerHTML+"' class='form-control'  style='background-color: transparent; border:none' readonly>"
          list5[x] = this.parentElement.cells[5].innerHTML;//harga member
          list6[x] = this.parentElement.cells[6].innerHTML;//harga normal
          list7[x] = this.parentElement.cells[7].innerHTML;//poin
          listharga[x] = "<input type='text' id='kerhargabrg' name='hargabrg[]' value='0' class='form-control'  style='background-color: transparent; border:none' readonly>"
          listjumlah[x] = "<input id='jumlahbeli' name='jumlahbeli[]' onchange='hitungjumlahpoin(); hitungtotalharga();' onclick='hitungjumlahharga(); hitungjumlahpoin(); hitungkembalian();' class='form-control' type='number' min='1' value='0'>"; //jumlah
          hitungpoin[x] = "<input type='text' id='hitungpoin' name='hitungpoin[]' value='0' class='form-control'  style='background-color: transparent; border:none' readonly>"; //hitung poin
          listhapus[x] = "<button type='button' id='tombolhapusbrg' onclick='hapustabelkeranjang(); hitungkembalian()' class='btn btn-danger btn-sm'><span class='bi bi-trash'></span></button>";

          var cel1 = newRow.insertCell(0);//id
          var cel2 = newRow.insertCell(1);//nama
          var cel3 = newRow.insertCell(2);//harga satuan
          var cel4 = newRow.insertCell(3);//poin
          var cel5 = newRow.insertCell(4);//stok
          var cel6 = newRow.insertCell(5);//jumlah
          var cel7 = newRow.insertCell(6);//akumulasi harga
          var cel8 = newRow.insertCell(7);//poin
          var cel9 = newRow.insertCell(8);//hapus

          cel1.innerHTML = list1[x]; //id
          cel2.innerHTML = list3[x]; //nama
          cel3.innerHTML = list6[x]; //harga satuan
          cel4.innerHTML = list7[x]; //poin
          cel5.innerHTML = list4[x]; //stok
          cel6.innerHTML = listjumlah[x]; //jumlah
          cel7.innerHTML = listharga[x]; //akumulasiharga
          cel8.innerHTML = hitungpoin[x]; //akumulasi poin
          cel9.innerHTML = listhapus[x]; //tombolhapus

          totalbrg();
          console.log(totalbrg());
      }
      n++;
      x++;
    }
  }
}
function totalbrg(){
  var brgkeranjang = document.getElementById("tabelkeranjang");
  document.getElementById("barangjumlah").value = parseInt(brgkeranjang.rows.length) - 2;
}

// function hitungankembalian() {
//       let kembalian = parseInt(document.getElementById('formbayar').value) - parseInt(document.getElementById('pendapatan').value);
//       document.getElementById('formkembalian').value = kembalian;
//     }
// function hitungkembalian() {
//   if (document.getElementById("inputbayar").value = '') {
//     document.getElementById("inputkembalian").value = '';
//   }else{
//   document.getElementById("inputkembalian").value = parseInt(document.getElementById("inputbayar").value) - parseInt(document.getElementById("hargatotalsaatini").value);
//   }
// }

// function formattgl(){
//   var tampungtgl = document.getElementById("filtertanggal").value;
//   var splitdt = tampungtgl.split("-");
//   var tahun = splitdt[0];
//   var bulans = splitdt[1].substr(1);

//   var bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

//   var bulanbr = parseInt(bulans)-1;

//   var gabung = bulan[bulanbr] +' '+tahun;

//   var input;
//   var saring;
//   var status; 
//   var tbody; 
//   var tr; 
//   var td;
//   var i; 
//   var j;
//   input = gabung;
//   saring = input.toUpperCase();
//   tbody = document.getElementsByTagName("tbody")[0];;
//   tr = tbody.getElementsByTagName("tr");
//   for (i = 0; i < tr.length; i++) {
//       td = tr[i].getElementsByTagName("td");
//       for (j = 0; j < td.length; j++) {
//           if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
//               status = true;
//           }
//       }
//       if (status) {
//           tr[i].style.display = "";
//           status = false;
//       } else {
//           tr[i].style.display = "none";
//       }
//   }

// }

function cetak() {
  var tanya = confirm("Cetak Struk ?");
  if(tanya === true) {
    document.location.href="index.php?page=transaksi";
  }
}