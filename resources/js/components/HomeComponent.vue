<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Electores
                <small>Controlar</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de votacion</a></li>
                <li><a href="#">Electores</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> Listado de electores
                            </h2>
                            <button class="btn btn-default" @click.prevent="modal">Importar</button>
                            <button @click.prevent="limpiar" class="btn btn-default">Resetear</button>
                            <button class="btn btn-default" @click.prevent="imprimir">Imprimir</button>

                            <div class="modal fade" id="spinner">
                                <div class="modal-dialog">
<!--                                    <div class="modal-content text-center" align="center" style="text-align: center">-->
<!--                                        <div class="modal-body">-->
<!--                                            <p>One fine body&hellip;</p>-->
<!--                                        </div>-->
<!--                                        <pulse-loader :loading="true" ></pulse-loader>-->
                                       <center> <ring-loader :loading="true" ></ring-loader></center>
<!--                                        <bounce-loader :loading="true" ></bounce-loader>-->
<!--                                    </div>-->
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            <small class="pull-right">
                                <button class="btn btn-primary" @click.prevent="create"> <i class="fa fa-user"></i> Agregar nuevo</button>
                            </small>
                        </div>
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Importacion de datos</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Seleccione el archivo excel a importar, esta opcion reemplaza todos los registros existentes y por los nuevos datos</p>
                                        <input type="file" id="file" ref="file" @change="handleFileUpload" accept=".XLSX, .CSV" class="form-control">
<!--                                        <table v-if="parse_csv" border="1">-->
<!--                                            <tr v-for="csv in parse_csv">-->
<!--                                                <td v-for="key in parse_header">-->
<!--                                                    {{csv[key]}}-->
<!--                                                </td>-->
<!--                                            </tr>-->
<!--                                        </table>-->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" v-on:click="EventSubir">Importar datos</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="modal fade" id="update">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-pencil"></i> Modificar datos</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" @submit.prevent="actualizar">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="ci2" class="col-sm-2 control-label">CI</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="ci2" placeholder="CI">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombres2" class="col-sm-2 control-label">Nombres</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="nombres2"  placeholder="Nombres">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mesa2" class="col-sm-2 control-label">Mesa</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="mesa2"  placeholder="Mesa">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
<!--                                            <div class="box-footer">-->
<!--                                                <button type="submit" class="btn btn-default">Cancel</button>-->
<!--                                                <button type="submit" class="btn btn-info pull-right">Sign in</button>-->
<!--                                            </div>-->
                                            <!-- /.box-footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-warning" > <i class="fa fa-pencil"></i> Modificar datos</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-trash"></i> Cancelar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="modal fade" id="create">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-pencil"></i> Modificar datos</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" @submit.prevent="insertar">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="ci" class="col-sm-2 control-label">CI</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="ci" placeholder="CI">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombres" class="col-sm-2 control-label">Nombres</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="nombres"  placeholder="Nombres">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mesa" class="col-sm-2 control-label">Mesa</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="mesa"  placeholder="Mesa">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" > <i class="fa fa-plus"></i> Create datos</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-trash"></i> Cancelar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table1 table1-bordered" border="1"  width="100%">
                                <tr class="bg bg-primary" >
                                    <th>N°</th>
                                    <th>CI</th>
                                    <th>Nombres</th>
                                    <th>Mesa</th>
                                    <th>Votacion</th>
                                    <th>Opciones</th>
                                </tr>
                                <tr v-if="electores.length!=0" v-for="(item,index) in electores " :key='index'>
                                    <td>{{index+1}}</td>
                                    <td>{{item.ci}}</td>
                                    <td>{{item.nombres}}</td>
                                    <td>{{item.mesa}}</td>
                                    <td><span class="badge badge-dark">{{item.votacion}}</span></td>
                                    <td>
                                        <button class="btn btn-warning" @click.prevent="modificar(item)" style="padding: 0.25em"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger" @click.prevent="eliminar(item.id)" style="padding: 0.25em"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr v-else >
                                    <td COLSPAN="6" style="text-align: center">Sin valores en la tabla</td>
                                </tr>
<!--                                <tr>-->
<!--                                    <td>N°</td>-->
<!--                                    <td>CI</td>-->
<!--                                    <td>Nombres</td>-->
<!--                                    <td>Mesa</td>-->
<!--                                    <td>Votacion</td>-->
<!--                                </tr>-->
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</template>
<script>
    import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
    import RingLoader from 'vue-spinner/src/RingLoader.vue';
    import BounceLoader from 'vue-spinner/src/BounceLoader.vue';
    // import jsPDF from 'jspdf';
    import jsPDF from 'jspdf'
    import 'jspdf-autotable'

    export default {
        components: {
            PulseLoader,
            RingLoader,
            BounceLoader
        },
        data(){
          return{
              electores:[],
              file: '',
              parse_header: [],
              parse_csv: [],
              color: '#cc181e',
              color1: '#5bc0de',
              size: '45px',
              margin: '2px',
              radius: '2px',
              modificarelector:{},
              elector:{},
              id:''
          }
        },
        mounted() {
            // console.log('Component mountedasdadsada.')
            this.datos();
        },
        methods:{
            modal(){
                $('#modal-default').modal('show');
                // console.log('aa');
                // import('@/vendor/Export2Excel').then(excel => {
                    // const tHeader = ['Id', 'Title', 'Author', 'Readings', 'Date']
                    // const data = this.list
                    // excel.export_json_to_excel({
                    //     header: tHeader, //Se requiere encabezado
                    //     data, //Datos específicos requeridos
                    //     filename: 'excel-list', //Opcional
                    //     autoWidth: true, //Opcional
                    //     bookType: 'xlsx' //Opcional
                    // })
                // })
            },
            spinner(){
                $('#spinner').modal('show');
            },
            activate(){
                this.$loading(true);
            },
            create(){
              $('#create').modal('show');
            },
            insertar(){
               axios.post('/elector',{ci:$('#ci').val(),nombres:$('#nombres').val(),mesa:$('#mesa').val(),}).then(res=>{
                   $('#create').modal('hide');
                   this.datos();
               });
            },
            async EventSubir(){
                $('#spinner').modal('show');
                $('#modal-default').modal('hide');
                // this.$loading(true);
                let formData = new FormData();
                let cm=this;
                formData.append('file', this.file);
                axios.post( '/import-excel-personas', formData,{
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                    // onUploadProgress (e) {
                    //         let progress = Math.round((e.loaded * 100.0) / e.total);
                    //         console.log(progress);
                    //     }
                }).then(async function(){
                    // console.log('SUCCESS!!');

                    axios.get('/elector').then(async res=>{
                        cm.electores=res.data;
                        cm.$toastr.s("Se importo correctamente los datos!!!");
                        await $('#spinner').modal('hide');
                        // return false;
                    });
                    // await cm.datos();
                    // await cm.$toastr.s("Se importo correctamente los datos!!!");
                    // return false;
                    // this.$toastr.s("SUCCESS MESSAGE", "Success Toast Title");
                        // this.$loading(false);

                    })
                    .catch(async function(){
                        // console.log('FAILURE!!');
                        await $('#spinner').modal('hide');
                        await cm.$toastr.e("Error al importar datos los datos!!");
                        // return false;
                        // this.$toastr.s("SUCCESS MESSAGE", "Success Toast Title");
                        // this.$loading(false);
                    });

                // this.$Progress.start()
                // await this.parse_csv.forEach(async (res)=>{
                //     // console.log(res);
                //     await axios.post('/users',res).then(async (res)=>{
                //         await console.log(res);
                //     })
                // })
                // this.$Progress.finish()}
                // this.$Progress.start()
                // let formData= new FormData();
                // formData.append('data',JSON.stringify(this.parse_csv));
                // axios.post('/users',formData).then(res=>{
                //     console.log(res);
                //     this.$Progress.finish()
                // }).catch(error=>{
                //     console.log(error)
                //     this.$Progress.fail()
                // })
                // await this.parse_csv.forEach(async dat=>{
                //     console.log(dat)
                //     // axios.post('/users',dat).then( async res=>{
                //     //     console.log(res);
                //     // });
                // })
            },
            word(){
                // console.log('a');
                axios.post('/wordElector',{}).then(response=>{
                    var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    var fileLink = document.createElement('a');

                    fileLink.href = fileURL;
                    fileLink.setAttribute('download', 'Appdividend.docx');
                    document.body.appendChild(fileLink);

                    fileLink.click();
                });
            },
            eliminar(id){

                this.$fire({
                    // imageUrl: 'app/doctors/'+item.doctor_id+'.jpg',
                    imageHeight: 50,
                    title: "Seguro de Eliminar dato!",
                    // text: "Doctor: "+item.doctor +" Especialidad: "+item.especialidad+" Hora: "+item.hora,
                    type: "warning",
                    timer: 10000,
                    showCloseButton: true,
                    showCancelButton: true,
                }).then(r => {
                    if (r.value==true){
                        axios.delete('/eliminar/'+id).then(res=>{
                            this.datos();
                        });
                    }
                });
            },
            modificar(item){
                // console.log(item);
                $('#update').modal('show');
                $('#ci2').val(item.ci);
                $('#nombres2').val(item.nombres);
                $('#mesa2').val(item.mesa);
                this.id=item.id;
                // this.modificarelector.id=item.id;
                // this.modificarelector.ci=item.ci;
                // this.modificarelector.nombres=item.nombres;
                // this.modificarelector.mesa=item.mesa;
                // console.log(this.modificarelector);
            },
            actualizar(){
                // console.log(this.id);
                axios.put('/elector/'+this.id,{ci:$('#ci2').val(),nombres:$('#nombres2').val(),mesa:$('#mesa2').val()}).then(res=>{
                    // console.log(res);
                    this.datos();
                    $('#update').modal('hide');
                });
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },
            start () {
                this.$Progress.start()
            },
            set (num) {
                this.$Progress.set(num)
            },
            increase (num) {
                this.$Progress.increase(num)
            },
            decrease (num) {
                this.$Progress.decrease(num)
            },
            finish () {
                this.$Progress.finish()
            },
            fail () {
                this.$Progress.fail()
            },
            datos(){
                axios.get('/elector').then(res=>{
                    this.electores=res.data;
                    // return false;
                });
            },
            async imprimir(){
                (function (api, $) {
                    'use strict';
                    api.writeText = function (x, y, text, options) {
                        options = options || {};

                        var defaults = {
                            align: 'left',
                            width: this.internal.pageSize.width
                        }

                        var settings = $.extend({}, defaults, options);

                        // Get current font size
                        var fontSize = this.internal.getFontSize();

                        // Get the actual text's width
                        /* You multiply the unit width of your string by your font size and divide
                         * by the internal scale factor. The division is necessary
                         * for the case where you use units other than 'pt' in the constructor
                         * of jsPDF.
                        */
                        var txtWidth = this.getStringUnitWidth(text) * fontSize / this.internal.scaleFactor;

                        if (settings.align === 'center')
                            x += (settings.width - txtWidth) / 2;
                        else if (settings.align === 'right')
                            x += (settings.width - txtWidth);

                        //default is 'left' alignment
                        this.text(text, x, y);

                    }

                })(jsPDF.API, jQuery);

                // var doc = new jsPDF("landscape");
                // // doc.text("Hello landscape world!", 20, 20);
                // // doc.text("Left aligned text",0.5,0.5);
                // // doc.writeText(0, 0 ,'align - center ', { align: 'center' });
                // // doc.text("Centered text",{align: "center"},0,1);
                // // let pdfName = 'test';
                // // var doc = new jsPDF();
                // // doc.text("Hello World", 10, 10);
                // doc.writeText(0, 7 ,'align - center ', { align: 'center' });
                // // doc.writeText(0, 80 ,'align - right ', { align: 'right' });
                // // doc.writeText(0, 120 ,'align - left '});
                // //Alignment based on text container width
                // // doc.writeText(0, 120 ,'align - center : inside container',{align:'center',width:100});
                // doc.save('example.pdf');

//                 var columns = [{
//                     title: "ID",
//                     dataKey: "id"
//                 },
//                     {
//                         title: "Name",
//                         dataKey: "name"
//                     },
//                     {
//                         title: "Country",
//                         dataKey: "country"
//                     },
//                 ];
//                 var rows = [{
//                     "id": 1,
//                     "name": "Shaw",
//                     "country": "Tanzania"
//                 },
//                     {
//                         "id": 2,
//                         "name": "Nelson",
//                         "country": "Kazakhstan"
//                     },
//                     {
//                         "id": 3,
//                         "name": "Garcia",
//                         "country": "Madagascar"
//                     },
//                 ];
//
//
//                 var doc = new jsPDF('p', 'pt');
//
//                 var header = function (data) {
//                     doc.setFontSize(18);
//                     doc.setTextColor(40);
//                     doc.setFontStyle('normal');
// //doc.addImage(headerImgData, 'JPEG', data.settings.margin.left, 20, 50, 50);
//                     doc.text("Testing Report", data.settings.margin.left, 50);
//                 };
//
//                 doc.autoTable(columns, rows, {margin: {top: 80}, beforePageContent: header});
//
//                 doc.save("table.pdf");
                const doc = new jsPDF()

// It can parse html:
// <table id="my-table"><!-- ... --></table>
//                 doc.autoTable({ html: '#my-table' })

// Or use javascript directly:
//                 var header = function (data) {
//                     doc.setFontSize(18);
//                     doc.setTextColor(40);
//                     doc.setFontStyle('normal');
// //doc.addImage(headerImgData, 'JPEG', data.settings.margin.left, 20, 50, 50);
//                     doc.text("Testing Report", data.settings.margin.left, 50);
//                 };
//                 doc.writeText(0, 7 ,'Universidad técnica de Oruro \n aaaa', { align: 'center' });
                // doc.autoTable({
                //     body: [
                //         [{ content: 'Text', colSpan: 2, rowSpan: 2, styles: { halign: 'center' } }],
                //     ],
                // })
                doc.setFontSize(10);
                // doc.addImage("/dist/img/user1-128x128.jpg", "JPEG", 15, 40, 180, 180);
                // doc.addImage("examples/images/Octonyan.jpg", "JPEG", 15, 40, 180, 180);
                // doc.autoTable({
                //     didDrawCell: (data) => {
                //         if (data.section === 'body' && data.column.index === 0) {
                //             var base64Img = ''
                //             doc.addImage(base64Img, 'JPEG', data.cell.x + 2, data.cell.y + 2, 10, 10)
                //         }
                //     },
                // })
                await this.loadImage('/img/logo1.jpg').then((logo) => {
                    // const doc = new jsPDF('p', 'mm', 'a4');
                    doc.addImage(logo, 'JPEG', 20, 0,20,20);
                    // doc.save('report.pdf');
                    // console.log(logo);
                });
                await this.loadImage('/img/logo2.jpg').then((logo) => {
                    // const doc = new jsPDF('p', 'mm', 'a4');
                    doc.addImage(logo, 'JPEG', 170, 0,20,20);
                    // doc.save('report.pdf');
                    // console.log(logo);
                });
                doc.text("Universidad técnica de Oruro \n" +
                    "Tribunal electoral universitario\n" +
                    "Listado de electores", 105, 7, null, null, "center");
                // doc.text('aa');
                // doc.autoTable({
                //     head: [['Mesa', 'Desde', 'Hasta']],
                //     body: [
                //         ['1010', 'david@example.com', 'Sweden'],
                //         ['2020', 'castille@example.com', 'Spain'],
                //         // ...
                //     ],
                // });
                var mybody=[];
                await axios.get('/elector/1').then(res=>{
                    // console.log(res.data);
                    res.data.forEach(dat=>{
                        // console.log(dat);
                        mybody.push([dat.mesa, dat.desde, dat.hasta]);
                    });

                });
                doc.autoTable({
                    // styles: { fillColor: [255, 0, 0] },
                    // columnStyles: { 0: { halign: 'center', fillColor: [0, 255, 0] } }, // Cells in first column centered and green
                    margin: { top: 21 },
                    head: [['Mesa', 'Desde', 'Hasta']],
                    body: mybody,
                })
                doc.save('table.pdf')
            },
            limpiar(){
                this.$fire({
                    // imageUrl: 'app/doctors/'+item.doctor_id+'.jpg',
                    imageHeight: 50,
                    title: "Seguro de limpiar todos los datos",
                    // text: "Doctor: "+item.doctor +" Especialidad: "+item.especialidad+" Hora: "+item.hora,
                    type: "question",
                    timer: 10000,
                    showCloseButton: true,
                    showCancelButton: true,
                }).then(r => {
                    if (r.value==true){
                        // console.log('si');
                        axios.delete('/elector/1').then(res=>{
                            this.datos();
                            this.$toastr.s("Se elimino todos los datos");
                        })
                    }else{
                        // console.log('no');
                    }
                });

            },
            test(){
                // this.$Progress.start()
                // axios.get('http://api.rottentomatoes.com/api/public/v1.0/lists/movies/in_theaters.json?apikey=7waqfqbprs7pajbz28mqf6vz')
                //     .then((response) => {
                //         this.$Progress.finish()
                //     }, (response) => {
                //         this.$Progress.fail()
                //     })
                this.$Progress.start()
                axios.get('/users').then(res=>{
                    this.$Progress.finish()
                    console.log(res);
                }).catch(err=>{
                    console.log(err);
                    this.$Progress.fail()
                })
            },
            loadImage(url) {
                return new Promise((resolve) => {
                    let img = new Image();
                    img.onload = () => resolve(img);
                    img.src = url;
                })
            },
            csvJSON(csv){
                var vm = this
                var lines = csv.split("\n")
                var result = []
                var headers = lines[0].split(",")
                // console.log(headers);
                vm.parse_header = lines[0].split(",")
                // lines[0].split(",").forEach(function (key) {
                //     vm.sortOrders[key] = 1
                // })

                lines.map(function(line, indexLine){
                    if (indexLine < 1) return // Jump header line

                    var obj = {}
                    var currentline = line.split(",")

                    headers.map(function(header, indexHeader){
                        // console.log(header.trim());
                        obj[header.trim()] = currentline[indexHeader];

                    })

                    result.push(obj)
                })

                result.pop() // remove the last item because undefined values
                // console.log(result)
                return result // JavaScript object
            },
            loadCSV(e) {
                // console.log('aa');
                var vm = this
                if (window.FileReader) {
                    var reader = new FileReader();
                    reader.readAsText(e.target.files[0]);
                    // Handle errors load
                    vm.$Progress.start()
                    reader.onload = function(event) {
                        var csv = event.target.result;
                        vm.parse_csv = vm.csvJSON(csv)
                        vm.$Progress.finish()
                    };
                    reader.onerror = function(evt) {
                        if(evt.target.error.name == "NotReadableError") {
                            alert("Canno't read file !");
                        }
                    };
                } else {
                    alert('FileReader are not supported in this browser.');
                }
            }
        }
    }
</script>
<style>
    .table1 tr th{
        /*background: red;*/
        padding: 0.5em;
        text-align: center;
    }
    .table1 tr td{
        padding-left: 0.2em;
    }
</style>
