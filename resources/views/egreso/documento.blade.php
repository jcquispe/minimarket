@extends('layouts.'.Auth::user()->tipo)

@section('contenido')
    <button onclick="imprime()" class="btn"><i class="fa fa-print"></i> Imprimir </button>
    <button onclick="descarga()" class="btn"><i class="fa fa-file-pdf-o"></i> Descargar </button>
    <a href="/egreso" class="btn"><i class="fa fa-arrow-left"></i> Volver </a>
        <iframe id="output" style="width:100%; height:700px"></iframe>
@stop

@section('scripts')
        {!! Html::script('js/pdfmake/pdfmake.js') !!}
        {!! Html::script('js/pdfmake/vfs_fonts.js') !!}
     	{!! Html::script('js/qrious.js') !!}
     	<script>
            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            var f=new Date();
        	const qr = new QRious({value: <?php echo json_encode($egreso->venta.'%'.date('d/m/Y H:i:s', strtotime($egreso->fecha_egreso)))?>});
        	var codigo = qr.toDataURL();
        	
            
            var entregaDoc = {
            	pageSize: 'letter',
            	footer: function(page, pages) { 
            	    return { 
            	        columns: [ 
            	            { text:'Generado por Sistema Web de Administración de Minimarket', fontSize: 7},
            	            { 
            	                alignment: 'right',
            	                text: [
            	                    { text: page.toString(), italics: true },
            	                    ' de ',
            	                    { text: pages.toString(), italics: true }
            	                ],
            	                fontSize: 7
            	            }
            	        ],
            	        margin: [10, 0]
            	    };
            	},
            	content: [
            	    {
            			columns: [
            			{
            				image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAAFkCAMAAAA5Yp3xAAADAFBMVEUUrpqENlv/w1mU0sT/ukv/4rGyQl2gPlxkwY2o2cr/997iIUv/0nP/YVb/zW6qP2JBt5T/t0oxs5f/WVX/ubGMN1X/6ZR6M1nYLkj/yUb1QVH7S1J5M1b/wkndxM/g8uv/0YX//v2ZO1r/yke64sv/kYb/xkn/q5qENlX/4d7/U1P/yWcis5idPF3/253/vkf/d2ntN07/6uj/uUgArJv+UFKcPVmUOVjpMU3LdIr/3oaKQV5Mu5H/v1PcE0j/Zlj/t0qrQFr/vEn/24Hu5erP69qJN12WO1f/nJP/9+aPOV7/Ylf/2NO9a4ZUvZFYv4+8c4n/hYVHuZRfv42RWXfWp7WIN1fKh5j/vlCmPlv/w0htxJWjPV/3aXX/vUr/xUb/9fWVO13/XFZTu5B9NFrozdWlP1//ukt1MlX/xkX/ZFaGzaX/6MH/yUr/XlaPOVeBNVr4R1H/v0nD5dH/vk6kPWD/Zln/xGJepZ2OOFsdsZn/dEhgwI7wWmv/5Iv9eX2ON13QOkupPWHZuMX/hnr/wFXzP1CANFWZPF2YPlzn19/Y7+B9NFbr9vD/13n/ZFf/x0f/qWH/z4f/lYXsNE1iwIyqP11eqqTnLU11MVnRna3/aFj/+/RYvY+iPVnZipqLOVv/i1L/x8GUOF7/W1X/3IrpP1//eEr/aFT/yUifYH2Pho/PkqWhPl//ko//X1b/Z1rvPE+DzMH/uEf/1s3/uEv/ZVn/Zlj67vBLupLvOk7/eEr/xET/ZVxsnpr2+/iUOVz/w0SoQVj/uEj/vEmvQVz/vE7fGkk4tZabPFf/wUq2Q2Dm2uH/vkf/cUplv47/v1OMOF6eP1nAf5L/8NJTuZP/fkv3RFHPfZFNvJJ5O1ioQFyZOFzlKEz/Z1hyNVj/ZleR0a3/Z1ep3L+c1bR4yZ369vf/ZVj/yGD+TlP/VlP/xEn/ykv/u1b/vE/uSmSfVG+LNVz/YFT/Ylf/1olpwI1dwYr/Ylv/zET/Ylrx+fT/uUj/wEi/QVVRvZP///+veYK/AAABAHRSTlP///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8AU/cHJQAAI7pJREFUeAHs0TEBhEAMALC31f0sdP+lujCAADxgoG5ARG9gSCzk9/ApQoQgRAijEIQgRAhChCBECEKEIAQhQhAiBCFCECIEIQgRghAhCBGCECEIQYgQhAhBiBCECEEIQoQgRAhChCBECEIQIgQhQhAiBCH/yqNjos+sS8gWKzvuHaJzCZmql70yRm0cCKNwNy58AZMi4CM4ldUY5gBbi4F1ue5zgLAsCwvbG2G2UE6gwp1xKRhUpFPjhUHttnsCwf7z5gVPCm1kpZ2nyfv/efqTYj40ERrqhWLHyhZraAQeM7lPQD6Kw0vJE2loNxCiV4pIviQgU3XKM5LwrmgMwp499woT9ACBc4pjfa+y/JSATNJ9pvzpilkx9oN6+X9kleoXjWjeLbLvCcgE/cqsslZRNi7wWMOp5bL9YrPZCI/5vOuenhOQW7V8zpSlFEwFU2goZOxY4m2U9M2VR3f4u/2TgNzGI7eWZz9d5KHF+42omQsQwXFYr/dPpwTkRh7a6tobZINbLBFewEXYQwiwQmT5S9/Aowk8AGQ1lkgCAh48SYKAi4CIJ84UAdqas/F7ek8cuK/AY79fbU8JyGgecrza1mIRjykCqDp8H+SxFiCC47w6jyWSgOS6qOtaF846p3XhpbGCNB9ENhQ6YzwhcTGPOe4r8Dgff9yNIpKALPNP1slJigpjnHtd8iNCCQYhhUlhh5QzBXhE9xWuKwAZRSQBWf422gSVwWFYFOMy6mNjNvOb2ry5r/h9rI5Hz+Pusn1IQN79Pq5nv3Oh+M5HZen70ic7FIcJHzLAgj7zr5BH84bHmTwuj18fEpB3eJjWtM6Us5nhklYcBuEVyo4znGMNfbmbtWZWCY/mlcdBtCcP+Q8iQB4vl2EiCQh4CA45SnmuqirvrXgchqTiYJzDfsr7torvq0P3jz0z1m0bBsLw6KHI5CWwtttigEuA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', 
            				width: 100,
            				height: 80
            			},
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				
            			},
            			]
            		},
            		{ text: 'VENTA', style: 'titulo' },
            		{
            			columns: [
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAAA1BMVEUAAACnej3aAAAAGElEQVR42u3BAQEAAACCoP6vdkjAAAA4EAn2AAHInXdYAAAAAElFTkSuQmCC', 
            				width: 60,
            				height: 3,
            			},
            			{
            				width: '*',
            				text: ''
            			},
            			]
            		},
            		'\n\n',
            		{
            			columns: [
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				width: '*',
            				text: [
            					'COD: ',
            					{text: <?php echo json_encode($egreso->venta)?>, bold: true, fontSize: 16}
            				],
            				style: 'derecha'
            			},
            			]
            		},
            		'\n\n',
            		{
            			columns: [
            			{
            				table: {
            					widths: [ 100, 'auto'],
            					body: [
            					    [ {text:'Fecha:', alignment:'right', bold:true}, <?php echo json_encode(date('d/m/Y H:i:s', strtotime($egreso->fecha_egreso)))?>],
            					    [ {text:'Nombre:', alignment:'right', bold:true}, <?php echo json_encode($soluser->nombre)?>],
            					    [ {text:'NIT/CI:', alignment:'right', bold:true}, <?php echo json_encode($soluser->ci)?>]
            					]
            				},
            				layout: 'noBorders',
            				margin: [5,0,0,0]
            				
            			},
            			
            			{
            				table: {
            					widths: [ 100, 'auto'],
            					body: [
                                    [ {text:'IMPORTE TOTAL: ', alignment:'right', bold:true}, <?php echo json_encode(money_format('%.2n', $egreso->total))?>+' Bs.'],
            						[ {text:'TOTAL EFECTIVO: ', alignment:'right', bold:true}, <?php echo json_encode(money_format('%.2n',$egreso->pagado))?>+' Bs.'],
            						[ {text:'CAMBIO: ', alignment:'right', bold:true}, <?php $total = json_encode($egreso->total); $pagado = json_encode($egreso->pagado); echo json_encode(money_format('%.2n',$pagado-$total));?>+' Bs.']
            					]
            				},
            				layout: 'noBorders',
            				margin: [5,0,0,0]
            			},
            			]
            		},
            		{ 
            			table: {
            					widths: [ 'auto', 'auto', 200, 'auto', 'auto', 50, 60],
            					body: [
            						[ {text:'No.', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9}, 
            						  {text:'Código', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9}, 
                                      {text:'Descripción', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 11},
            						  {text:'Unidad', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 11},
            						  {text:'Cantidad', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9},
            						  {text:'Precio', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9},
            						  {text:'Importe', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9}
            						],
                                    <?php $num = 1;foreach($detalles as $det){?>
            						[ {text: '<?php echo json_encode($num)?>', alignment:'center', fontSize: 10}, 
            						  {text: <?php echo json_encode($det->codigo)?>, alignment:'center', fontSize: 9}, 
            						  {text: <?php echo json_encode($det->descripcion)?>, alignment:'left', fontSize: 9},
            						  {text: <?php echo json_encode($det->unidad)?>, alignment:'left', fontSize: 9},
            						  {text: '<?php echo json_encode($det->cantidad)?>', alignment:'right', fontSize: 10},
                                      {text: <?php echo json_encode(money_format('%.2n',$det->costo_vendido))?>, alignment:'right', fontSize: 10},
                                      {text: <?php echo json_encode(money_format('%.2n',$det->costo_total))?>, alignment:'right', fontSize: 10}
            						],
            						<?php $num++;}?>
            					]
            				},
            				
            				margin: [20,0,20,0]
            		},
            		{text:'OBSERVACIONES:', bold:true, margin:[20,20,0,0]},
                    {text: <?php echo json_encode($egreso->observacion)?>, margin:[20,0,20,0], fontSize: 8, alignment: 'justify'},
                    { image: codigo, width:50, height: 50, margin: [0,40,0,0], alignment: 'right'}
            		
            	],
            
            	styles: {
            		titulo: {
            			bold: true,
            			fontSize: 18,
            			color: 'black',
            			alignment: 'center',
            			margin: [20,20,20,0]
            		},
            		justificado: {
            			alignment: 'justify',
            			margin: [20,0,20,0]
            		},
            		derecha: {
            			alignment: 'right',
            			margin: [0,0,40,0]
            		}
            	}
            };
            
    $(document).ready(function(){
        pdfMake.createPdf(entregaDoc).open();
    });
    
    function imprime(){
        var soli = {
            	pageSize: 'letter',
            	footer: function(page, pages) { 
            	    return { 
            	        columns: [ 
            	            { text:'Generado por Sistema Web de Administración de Minimarket', fontSize: 7},
            	            { 
            	                alignment: 'right',
            	                text: [
            	                    { text: page.toString(), italics: true },
            	                    ' de ',
            	                    { text: pages.toString(), italics: true }
            	                ],
            	                fontSize: 7
            	            }
            	        ],
            	        margin: [10, 0]
            	    };
            	},
            	content: [
            	    {
            			columns: [
            			{
            				image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAAFkCAMAAAA5Yp3xAAADAFBMVEUUrpqENlv/w1mU0sT/ukv/4rGyQl2gPlxkwY2o2cr/997iIUv/0nP/YVb/zW6qP2JBt5T/t0oxs5f/WVX/ubGMN1X/6ZR6M1nYLkj/yUb1QVH7S1J5M1b/wkndxM/g8uv/0YX//v2ZO1r/yke64sv/kYb/xkn/q5qENlX/4d7/U1P/yWcis5idPF3/253/vkf/d2ntN07/6uj/uUgArJv+UFKcPVmUOVjpMU3LdIr/3oaKQV5Mu5H/v1PcE0j/Zlj/t0qrQFr/vEn/24Hu5erP69qJN12WO1f/nJP/9+aPOV7/Ylf/2NO9a4ZUvZFYv4+8c4n/hYVHuZRfv42RWXfWp7WIN1fKh5j/vlCmPlv/w0htxJWjPV/3aXX/vUr/xUb/9fWVO13/XFZTu5B9NFrozdWlP1//ukt1MlX/xkX/ZFaGzaX/6MH/yUr/XlaPOVeBNVr4R1H/v0nD5dH/vk6kPWD/Zln/xGJepZ2OOFsdsZn/dEhgwI7wWmv/5Iv9eX2ON13QOkupPWHZuMX/hnr/wFXzP1CANFWZPF2YPlzn19/Y7+B9NFbr9vD/13n/ZFf/x0f/qWH/z4f/lYXsNE1iwIyqP11eqqTnLU11MVnRna3/aFj/+/RYvY+iPVnZipqLOVv/i1L/x8GUOF7/W1X/3IrpP1//eEr/aFT/yUifYH2Pho/PkqWhPl//ko//X1b/Z1rvPE+DzMH/uEf/1s3/uEv/ZVn/Zlj67vBLupLvOk7/eEr/xET/ZVxsnpr2+/iUOVz/w0SoQVj/uEj/vEmvQVz/vE7fGkk4tZabPFf/wUq2Q2Dm2uH/vkf/cUplv47/v1OMOF6eP1nAf5L/8NJTuZP/fkv3RFHPfZFNvJJ5O1ioQFyZOFzlKEz/Z1hyNVj/ZleR0a3/Z1ep3L+c1bR4yZ369vf/ZVj/yGD+TlP/VlP/xEn/ykv/u1b/vE/uSmSfVG+LNVz/YFT/Ylf/1olpwI1dwYr/Ylv/zET/Ylrx+fT/uUj/wEi/QVVRvZP///+veYK/AAABAHRSTlP///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8AU/cHJQAAI7pJREFUeAHs0TEBhEAMALC31f0sdP+lujCAADxgoG5ARG9gSCzk9/ApQoQgRAijEIQgRAhChCBECEKEIAQhQhAiBCFCECIEIQgRghAhCBGCECEIQYgQhAhBiBCECEEIQoQgRAhChCBECEIQIgQhQhAiBCH/yqNjos+sS8gWKzvuHaJzCZmql70yRm0cCKNwNy58AZMi4CM4ldUY5gBbi4F1ue5zgLAsCwvbG2G2UE6gwp1xKRhUpFPjhUHttnsCwf7z5gVPCm1kpZ2nyfv/efqTYj40ERrqhWLHyhZraAQeM7lPQD6Kw0vJE2loNxCiV4pIviQgU3XKM5LwrmgMwp499woT9ACBc4pjfa+y/JSATNJ9pvzpilkx9oN6+X9kleoXjWjeLbLvCcgE/cqsslZRNi7wWMOp5bL9YrPZCI/5vOuenhOQW7V8zpSlFEwFU2goZOxY4m2U9M2VR3f4u/2TgNzGI7eWZz9d5KHF+42omQsQwXFYr/dPpwTkRh7a6tobZINbLBFewEXYQwiwQmT5S9/Aowk8AGQ1lkgCAh48SYKAi4CIJ84UAdqas/F7ek8cuK/AY79fbU8JyGgecrza1mIRjykCqDp8H+SxFiCC47w6jyWSgOS6qOtaF846p3XhpbGCNB9ENhQ6YzwhcTGPOe4r8Dgff9yNIpKALPNP1slJigpjnHtd8iNCCQYhhUlhh5QzBXhE9xWuKwAZRSQBWf422gSVwWFYFOMy6mNjNvOb2ry5r/h9rI5Hz+Pusn1IQN79Pq5nv3Oh+M5HZen70ic7FIcJHzLAgj7zr5BH84bHmTwuj18fEpB3eJjWtM6Us5nhklYcBuEVyo4znGMNfbmbtWZWCY/mlcdBtCcP+Q8iQB4vl2EiCQh4CA45SnmuqirvrXgchqTiYJzDfsr7torvq0P3jz0z1m0bBsLw6KHI5CWwtttigEuAUH2EglOzZ6GHDh0MaNSmLob4ElmitfErcPVYd8jiPoA11i/QO/6mQkdOUaRj+Ismj5Sy8PN/1Dkfpf6AP2YMhHEUVXF7lYH8hQfv4vae/TES7zyI/KO2QurbuP7Aec7ukIRVFUWxv73OQF7j8fPLdnJOWg9hEmH13J3wUQr++DA+P2asasY8BAiIZCDneOg73kuttKaJ+l+RTvMV44j1B/LVEwyyZ81BJAMZ8bjHd9sp7e5UUBua0vyhELVhFQMCXJhIN8E9p054oDwXf6xWRxwFeNzM5yCSgYz8sdX6+0aHbaU2iFoJhgmU3EmEqfyl28h0fH4IjgHIMV/dsJjI43UGMuIxUY4TlXOO4gbbMHhqcUkIFOkqFtD4suRIWbd7pf5gGqvVUwUe+yLg6OfT/vEqA3nBwylFTrUEGGTfqlY6n/oDOJJ6sGIgR3/s56y+76eRSAYSeWjllHXk3oCjTSfEOOyZfMUK/jge5+AxjzymHYhkIODxWW+cU0Q7huGZiPXeW5H0EmIBbZDHsmdhHQ+19sz7FfIVDBJ5AAjTYB4diGQg8Acp4mbJ76wXPbxZxpuHM/Ug4xiOc7zuFqk/WIsFiGQg7I+NvNOWO9vCGOBhDJqxYcRlhhidjYEMIXywl6gH4Y/0993ZCjyCPZCwhEfXd92CBY9kIOwPR8qSp7K03pbe17WvbdxhQGjSjefWYBgegDiozcv/RyFd4TyfVfH8OCYstkc/BY/leslEMhD2hyYqiY5nQO398w43TYPRxBE6nTRN6Gpjfhhzmb5fxfoDOOCP6uQ8R7bqFt16uVh/BZF3CwQ83NY5Eh6lZRae3SHfeUYRMXAEJtIBkXTxAXS1qRvG8eyPX6f1B4AIjpTHFGKHMI7Dxe+LT1fvGgjer8gxDgFSeiHia8OSrmZxF6dhJYZYxViDl9y8HPPA71eCIx7oIWEN/kC+Wi7XF4fDYf2HnDMIjeO6wzg6lIWk6z20G198saB0weRS6Ir46rLrmAhscKcIZGhB2cNgkHrIFFHspBuKMYgMxSBKBoZxSctiWsuFshPoxbeyUARSTCmYDsMePM3JrPZQdHK/7/3f2zfap6ayj7PfvHlvZuzT/PL9v/fmbUwiCwzkxVejNgoWWHQFiIYgLz5JhIF5AMkDGQ0gdnh20EmSU+dXsj4nEPl+BRrWIBIgIHJ0dPyf4z2/fvWDBQbyAvlxvz2CPborSBACkXfMl50IkER6GTjiQi55iEza/MrNDwmQufwo+0MB2YM/6rCIPz0mkcUEQh60x6gLh0A/29xEfihNkAeiiR6NJs4Fr3GTJJ9MTqwH5/yBemV5WH8gzWWChfyoT4+nx8dF+OCDhQRCHnEbRLrL3RUB8lTqFXXgyr58NJfL5Nqp30v0fHf2PREFS+MQIMJjD+6oT4+mYd1Pp+HVvywgEPI4bKNiwSDKIZswiAGSJPaFo3F0sPDZxP6l5oHyx9vO/sef7fzq5+Bh57tiECWFY1ofHk/TcBqmOYksGhD643BEIjCIFCw6hOksPCaTyQkEMzalP2PvJR1cJHPrDwIx8YE2tz6nQbQ/OL+qo1ppgUcUjqcksmBAmOft0QgLEB0hm083Jc8TSBlg0ulMJhjKdpjYU8DgryTg8eifbzv5QSBiD+d7ovBQsytdsNCIw/dTPw/DlMm+SEDoj1gRUQYBkU2IBYs4pGJ1/qcO9MCR2DrXHn366uXf+HsGN8/t+oP5oXnYgkV/EAYagPh+kOIYDgMSWRwgwgM7tu+O7o9WQMTwSLYTyuM7PzidhSOULPB49erlb0/6g/UKEn/I+gMSHqQBAQcMAh66Zvl+kWdB8STLojGJLAyQn16vxYe19iEMAofQH0/LBjH/9Z+RyCfkAd35w4n9DxPn5f3zOXuABuwBGIZHkGVhMAyjPB2zai0KkC+vt+O4LRWru0x/mDkWzLGddLwlvOYlHJSMS/be3umBPDQRPd019YpxLkCIYy7PpWDJhNf4IyiKKAzzvBinecZkrzwQ4RGvHR6241GXmW4LFh3i0SCJeumahiEig+VgbiwPEHn5r/Lvr8ijXK9snhMGaUDWH0UQAEieZ3mWpYN04F/9XfWBCA8ECOa8UFcDWREezQ4M4jk+sAOxmD9zeEC3Xur9jxPrD5cHF+gEUt/bk/wIw8IvKPgji7L0SRDhgkQqDoQ8+P9uxFyk0yCsWHTItSbz3NsGDk+ALFEd03Rn7z3eGh6WyB1ZDzLOwYP2IJAfuvNdvQCx/kC9gjXynB2ghFEaDUik4kC+XAWPtVqM/CAQ8BAisEfS9Dqe5wGGPsrakk5kWT2a/8dkPr4jeV6uV+764wtJDwIR+QIkl4JFFVEajumRKgMhj+c9EIkVkdFyVyeIAEm2vcksO+a05VyzJw+HiCzQ5/LD8ccegaBpHgyQvKQCYMIwikikwkBeXH++1juMWbBG3Lm1PAjE255MDIqOC2LLuScPl8gt7Q+bH8Rh8xwJYpcfJ3hkUrIIJMzzNE9J5AcVBnLxvQYMQh6HbQhAhIjwQH6IOxwr8HQs4/LQunHL3Y+y6w893QUQohgKD584pFapPieLPESfDh5crC6QPzZ6u2sGCB2ybIAgP4RH2QxG+pqdlZsfJY/I/ErWH/P+UN+v6jSIFuMjKHyJdIoXuIvyPIqKbPDdygL58L3e7npvfa3WbqtJlvbHSnN7G2GOc4Zj/u1bNrPhnsvDeuRjmV85+SH+UPVK8whDJ89zDuk4TwtZjzy4XVEgF1cbjd1eb72GSe+o1h7RHgTS3GxOGCCYyVogONltsD9V38CDRDQOy0NW5zbPCcSuz4tZgFC8SLMURKIhnnzrYjWBfN5o9Hq9tfU4flcvQrrwCHk0m9te0xOHCIt57cggkDa2NpZuOjwcIgAiCxDhYSa8Zv9cEQnFHn6heOCQBpkHUfbk4e1KAnmxCiCNtZ4CwkUIHYLWhDxkCCT++EZtkJfrD5fIDVOvqO/YDyYAoqe7Q8kPSOpVrkYLhFd5FA6Dh8/eryKQHzf6IGIccmIR0kTFohjmpXcv2lE972SEW87/Xx4kwoI1970dOLBfS9Ed9vsVMfDUvVBRHUpW+I/Lt6sHhAnSVxGCUCcQmfMCBhrmvC3h0VqaGUHevmAwNNhwPDrLvyz64MbXTp4zP47t9xKYIzAGsYkuzRSvcZQ+vPzsYvWAfEiD7PbpkHZNIgQ8lEPgjwQ4Wi3tD8Jgd5pokJvgcQY9vuH8Ho5ALA9fAfEJxLrDVizlET8Ns99cfud29YD8pIGC1YdBNBAxiJQsJkiLkyy3YFGlaz4/Gw965PHXs3plAgSaiqReKRj6FB7iFhPwUVAMrly5+6x6QFb7jZ7MsmoxgJCISRBGCHmIQ6RcnQpEPWe9OjMR8/t22T8XHBIgwiNgkmtPCA05C2GUBdkw++uVy3ffqhyQHzFCECLrax/FbR0hXV2x6A+0FgLkHmDs4BSdZ5Mrc56dB/W9x+IP+XylNkDs/jniPMiCIhMg+cwi+kbYhMHgEoG8XzUgnzZ2UbNYsmo1FepmVaj8wQTRMywSoRM0DPa2nbleWY8Ah0ywgONoDzCsPzKfNHSCWyA5n455pgEePfwMQN55VjUgn6NioWGWJTzayxoImscE4UEcmOXu7GgU59k0FRIRf7wmkS/0BiHiHDxEYaE/lxR52RviCjWkuB2Msyz95bcVkLeqBuQrJAh4fLQmQEqb6U0NZKtFHIwQ4wsCMeKjC0v0x2sTke1aAFHL8yFwSL2arQOpuUzPQCQglP1zAPL7CgK53u81+pxlxQAyQsUyq5AmBCIChBkChxggHAUK7y9IvXp9IkeMc7RyvSoCcYTrEOERDLIUCbN/6ZxyyN3KAVkFEGZIDIeYORaBzHjca2kcJSDWI3zwZjxIZO8I6TGb74b0RyDlisJQjnOVIXnKr1jD/X8LkAo6ZBX1qt/vP1+P/1Qjj/sCBOKcVzJkR/KcEgYlIDhu/v3Vm+n7j4/kB7yioiCPwhdLCAwxisHD7glK1v4vLp0791lFgez2uTJkhNTKe4VNTxaFrRbssQNtsBMKFy6w15cb5PHGROom0EOzX+sXdj1olZshiNJs/9f/Je+MXVu3ojBOvXQKb2nJoilToHhNV23JH9AhhRB48PA1byyV3uAtEPxaAho6BUFnLQGBse5g3mQh8JDgv+D6ksVZXoZ6KMVD+333+EbuGxurg3yeJHv/8TvfOdd6BIK01RACia4uehAERI5chvit8BgdC0CGQwFySCC+YwW8CYY8/nOdnf3xr/ev3ssrP1tIcPsPUSaJH64/tBkIGlb0hlNvFycnp+4gC+UShH4wP4ZeDl+3t3z28e9VPOjI2eqgwDbo9o+lMPA4TH1U4h5ZYmPzaB8+dz48PbUaSA+GuEyXLcQfvAOHA+La1WHwztMAD1wLNqxX8iCR34qD5epP+hHbGoj3RL5Cm9ikMbGYh8/XnU7bDYEgd1930bEoiDdEDk2G9OOdNyQACiECR8Dkh1//Zr3Okb9WB7KgMz98WPhPjyU1RWx1HA+e5/NO57sWGxI5ID2X6fJrIXmgyIOGDIHDGxJseLh78Xo/JEf0amWXKL+fbzcrlntqszSFHYyr+XWn9RlyJUNWdwZDUMID5YDcQBESARCX4p7JIiCPnRBJMsvxql7/BIoRMIIoszaLB+PyfM6W1WpDmCFsWfyv0DPHY9OxuBUKDRoCHn22LCl82UG/8l3LgIaUAKnf/PEPU2iTDqbl8/m80+4MiV4M4RtAfLvBr+lf1YLQjAAFHL769GNnRPTyZbBifWEHP/NUD0ZjVf08n7ceSC/CkCWGOCAkQkO4FG7sQPVR2zz492t3R8TKzCuPL34f5F1kehCOR4iQ8+vOU5uBYC3svcGUdXdy0mWEeB4OyI2Ui48+DBEY5EIeOyVizHurjcNBNh5Jpk3yqFFmEKrpSFUM9XYbEvWuImYIh6yPMvUKEHeKRR5OkIDFLMctPHZNJNP5J/HC1jmiH7Ms0bk1D2EYluv9ABJF0e9u6j19e1oDkZl3AyToUxBpWYv+7nmQCCzA5YDUx72x1QWwLAdhuAaQafU8b/1iCCSyqDNDPJBjt4a4RD8McKF8hjTCg0Qek0IwoDyYIjO5SRLkR4hIH5dVdd56Q+jIxZYhdaZvTrHIA5cDsqj7VQOOZNtA6gnYTsJwFMKRUbUHhtRAMPS+AKEfQwckCG5kwnJAGuMhORLHPj/8IsK3GibrMFS4xuG6/UCuegKkO5vNKMj3soU4IE4QkYMwGuZBIukGgydibW71pFQ0ZKzWU9V+IBH2wgtMWV2/FrrXG2ogQSBEbjcl+2BzjkjZl00kKyYKRUPCUlWqar0hEeoChnS7AoR+fCs8JEL6Ikh/gUeTfrC+OTM2ybWJTQFNClMYMylLxX5FQ0Kl9iHUexEzxAF5CyA0pAYiIxZ53DbPg0TQpfQnYxKTpibPEvAYVeO1Y6Km6nkPQp31I3BwUWekeyLD7ZbF8ap5HuKINjpJTVyY+NGCR6lKNQpRYoic9rZ+7O3OwONIIkR4SIaIHyguhMKjeUd0nidZYUy6HFxelpcl7XBApvuwqbMu7tCyjtyQ5bbCrQxxPAIGyMLzaJxIDEmsTq2ZXP50X5aVpIhrWWovgGDIOgGQXxghsoV4IAGIAAczvXk/aiIGRHLwuAeP+3sYwhorxT1kL4BEMOTo6GO9px+736aGFESAiB//H5E0NvE/7N3Pa1vZFQfw0BAmMl2Y2T2oOlVkxEAtr7IbL2bRUrKIVGyagjHWQlAR8KOgJBCMd0NIptOAGBADbbTU4jX1psFQgcl0iBiCQFRQK+DZtNClhOnCEaZ+zJvzvUfn6eqipa4W7+om7fwBH86Pc+590bt0tdvdq1TaV8cVBnFhDvkdmiwCoeW7GgsBIhWEPfjAY3EitEX5z7swDKuVLmo6lRDVZR1XXNhl7VKAHOXzchuiQBAif0TGAsjCPSDy53fpdDXd3UOXxYMhuiyKkMSD7FKEKJBnGgidOGOphLVQD4i8G4TpkOoHtVnsoUAc2PZSfKDLQoDc0jLW03GPxRz//uqjBYOsDNKDsFolkLYCUSJXb66SP6ljCKGspTYnWoQ8lRoCkO++uv23xYqsXHyT3kmHnXRbUhaDVCrnPRciRAPBJuse13Q0vdRiweM2RBbpMRicpDudanVvb68SR8grmdTdSVnx9a0WIPBYpAg8Tk7S6UE13ZkCcaDtldUJN1lGhDzlqXDsce3awkRWmvdzuZ00dVkd6bKcWZ0gQrjt1btefIYgNV08SOT6YkROm4NcLbczSIdhh1dZACERTOoOdFk4+aOjW/l4UL+H+OAawh7goHNgWUQ8/CAY7BAIhchkDsHBLgsgyd72ooYgQp7RpM67XpnTCSSOD3gc2BYRj1ypNhionFWVCMFBDXFhMKSul0Bu5REg+lyoedAhj/WDDy2LwCNLAZLLDQZmhLixy9IjZAzy+3tyO4V6roGsK5Hntj2ytRwdylnpME1FnaqIPoc48S5LFfVnEiHUZCE+Pv7Jx1r9OFAe6+sfIkasx4dPIJyyujwYfip36i4UdV4uyhiirU40DwIhD+Kgvyl7IneawdDP+sPcfU5ZoaSsT+MIOT93Ydu7K22vRAhC5JMZ8UHn7dtUJrJzMs0gSxwBJa37AAlDbTCUlHXuRNurBkOkLFkucnzgKA7SII515bH6NhXZOTcug2zgqZqe2wEIR4jykLbXiW2vipBbDCIvHLT+CiAHEh50Vi0lrZWml8UJgpqqIQTSlZSFADmmtydOgEjKkg+iaVB/+sljzle3D64xxwRkdXXVTog0PT8bEMhwGHCXhTlEijodLupOpCx4ACR+tvgdPCRAcBSHeCBEbFT0oe95KkImINT2CogrgyG2vUdxDSEPCpBxfKCgKw7UD/HA2bIRIhtZj1qsrDcN0taKiBt36lLTMRhyymIPabDgocUHRLZaqa+jeZ8XaLG8S46QkpGyZA554woIF3U87BUP0pAGK/aQ+NhqbX4x/5nQQ3D4DJIrqaKe7lbj9buA4EN1N0CwOkGTxR5SP9QGa136K2gAZHVt/iXdH14GNQExuiz9gsqNlHXE1yHiAZEDjo8DMz7Ig3JWZv4gNBRmUUQmba9sewUEk7ojbS+arH+ghpj1AwlLiw/l0WqdFeZeRGirCJEJyEDW71rb68KNYR67EwQIfj5d4kPy1brugQMOKiHl/nMbIJ5qewFSYpCORIgi4TlkGuROMiNEdoufPxYOAdHTFcfH1ubmWbk8b5BMU4VHXEPkPkR7BSTb3p4bKYsqyK/gAQ7UD4kPo35QeLQ2C4XC3EEIwx+DDOOijjlE7tRduaDafSTLxc8lPrR50MxXqB+b5UJh/hFCFjGIDIa87dUGQyceyuHA49Z0vlonkGmOVc5Xm+VyoVywAuJJymIQriFSQiDizPpd8wCIzINmfwUOaNhIWQgPD5sTfQ4xI+TYAZD8IwaR+hGPg5qHxEdr84w9Go35g9Ck7sNDQDhlyWBIx43Vya/VfcgHR+wh44c5f5CG8tjso34UGsWihZTlefF9SAmrE9n2Spt1zDeGPe6yfpxQkH+pxcnu0Wtt/pD7Wm2dyCDU7qr4KFoBQb7SImQgINpy0YHvQ/6U3z16dPTs5fg+SvOgo69LkK8IBPWj2Cg2bIF4k6IeSlGXtteJzxE+U4usv8TtLv3R40NAMJ5vKo8iPIrbNkBwjAiRos4RIk9Jkzyp//3ubv7RB6/ZQ+JD3ydyfFCDRfNHmQt6cXvbBgjSlaxOECEmiH6FKzVkJZMoEOl7/xdPH+P3ieZ6lw4aXnAgX21v37QZIUOADARE1RASmfkMaCVKHMhfqaS/lPDQ9lc6CGlIeKCgH9qJEF4uehwh6hlQd/LqxHyX9fPEgvyBQuS1uiCExhSIVs/Fo9iAx+GhtQgRkLjtbespy3y5ePoicSCYRGgGQXwIh9lfUYD0lQc0GhQdN0c35w/i+WOPbI3mEFXUQwapTL5TPzYi5DRKIMhn+bwB8lafz1E/pN1FuqLoOLQDwlOI3Ifs8I2hrN8ZxJjUT1eSCJK5m3+s3UcZ8QEQ5CsBUfFhAySrgQS5SYTs6XfqJkiUPBCEyF2qIeDQ64eAEIfhcUgedSsg7IGUpU3qkytcoFzpV7gIkOSBoIq8nHFfq8dHocz91TbV85HyqNso6mOQQH9KOgVi/Ityp1FCQX7x29n7XfGIw4NARiN42AFhEe1OPYzfZVVmpKz9F0kFiX6TUiLy/kqvH/2+Aik2AEKnTho4Voo6b7O0GoL7EFm/myD7p1FiQaKfXjcupLbkwU8ZIDx/0PhxOKojPuzUkCyLIELwlFRqCDwgYnRZ+/tRgkGitesAmRUfBTWfQ2MbEvS3bjFCtC4LIcLb3m/Zg7e9vR7PIfBIMEiUuj6rnrMH0hV5AAQiMKlb3fZylxWqOUTe9sou62HvyRMCuZFJOAhE9OcMMn8gYXH9QD1nEBzLIHJj2MGyV9v2KhBqsuCRbBBkLQERj/5UgzUaEQaRWAXRPtjhbwyn/mUNmkMe4oJqAx6JB4lSKd3jjBdYReaAh2QsuxGCLqvGIF15KKdP6r2HT350I4pcAInWUlq++p7GwbKEB9UPBhESSzUEHtOv39vxHa4aDNvtXm9jI+MGCGJkst/tEwjaXQERifH/2S/qOyjqk+9DpKi3extR5ApI9CAFD7xPpABRIFw/DsmAKWyCyKuTYVDCttd8l8WvTh4iPpwBgQgCpH9WkPtB3ICM2EIKiKVdljmHoKhXxaNCPwr2qv3m/AIeDoFApN9vnfE+sYgj9VyO5S7LM99lSVGnP6+urpCvHAKByH9brUKfPGQgRL+7KBBPXi5yypIagvMKP5v3JeLDKRCIrLX68v6qsS35CtXDNoiWskqcsrqTO3X8bt6XiA/XQCBS/r4gHHQdpVHU7YPo216+DyEP/pdO4OEiCEQaDbn/mK4fgmPtkYO0vQLSViAYQRAfboJAREAOJSoMEZvLRS1CunFRFw83QaJfrsmFbQxSl//ZA/FmRIjch8DDVRARofh4P5LRXFwkSiyDlASk+217TzwcBoHI6J/U8b4XB+2/8FjAfYj6xrAzXi7Cw2kQiBRHdT1j1adgbE7qkrIAQuveLs0fNyLHQSDyoD5rRF8MiMwhlLG67TfwWIKQiMSFeer2L6hkdYIrKvZYgkRfPMBUWJeiPlXZ7dcQRIh6SnqhPJYgEFnTo8J2DaEhHTGig+CDHRUfSxCJETNl2V+dGHOIxMcSRGJEFfaR1vjaXJ1QjPAuq0QlpNvpdtljCaLXkTrtT94vJEL0zxHQ9O5Uf6Z5LEGk15JTl1vDxeyyTsLQiI8liPRaAmK/hiBlDRXIN+mO4bEEERGkrLqA2F0uSg1Bzoo9liCmyEh7AsTDom2QQWlgeixBNBFjULc/qZ+UZnssQbQJsW53MGQPmdThkQAQyzEykp2vDZBaQCJDL6gFuVpwsR8lDsRCHXl/CA17c4jv+6QS5ErwSACI7e5XLqisgOD4waXn1/xc04JH0kCijyBi83ME1WblfN9CvkokSPR8jcu6nZTVDHgy9HzPQnwkEAQidIcIEZz/R3M+zYACxPeCy2HzNEokiIXzdTyPPMjMHQQtL7LWxZ0ooSAWTkatGusEYuFHDEkkyDY3XkRJBrFQSIhkRAFi4TeoLoNLC+kq4SA/sGv3qqpjUQDHq8BgYZXeFEoIMiH4DCMoWAwcprKxmcp0AW126a4k+ABaBaaf6ra+wBQWqTcnxPMG9mu4dz6ycmJ2sowXLu71Ly3zY7nJ2gGIp9H0DM/vZP3hpxj6VUA4BmEQjkEYhGMQjkEYhGMQBuEYhEE4BmEQbp6GlrbwpUHifTRsVwS/Ff0CmiaLxNaW1GJYjmzMeV2Qaf4hWpfBz0W/12LYI9XYqOZ2pC9xxoFMscZTQFb2TuEoIHNf4swDOV+FPjLIxFU4EsjJktJskMGHeC7IylYoIsi8Lw0HGSzFc0G8nXocJNxKk0DoHnSQJFCPg1hSGg5ypnvoQezN4f1hEF8aD3IVzwVxFa1R2cN4kL14Loj7ZfM4SHhhkOtzQRLEQQbpyUp9x7cqjV8YJBZPBfE2FZDdyLUrBcc7IKexLDe25nAv54VBIoFbRwNo132QVaBKHQN7Avca3ZsQ/xNHCDhDQPKfkEcOpegg7kbhggRQTSCpLOUDmAiS4fmAjiCLksfRBaCA9CUuBAaJuoLsFC4BEkj42YNBzh1BEoU6JEADwQNy+erBINARZLcpzQcNpFc5Pxhk0A3EQxx/ukAE8ZHH9sQgX8u7gbhf1P8FKyrItnyAGAuSC1TUCSQoHSBEkB7yGAPO6BfDPH4cxHt/LwYEqCAWArEaQXh1ss6yYRRrQWxVZJNBfAQybwnCy8VsrwHBR8iEDIKecR9agvD6HZFUQdAz3gEVBJ3pF8tsEMgEqbwOJDio/3LpILIoNBqEfqW+Pt8HKY70TdIF5JIaDgKRoIvcAVFFi04TYixIBxEG+b5FS0EqZ5Af7NPF/fcEsRgE4DwkDUmmB7Ghy3vIjUH+IVkTRAba95AZHeSGdr0M8m/xdFhTnn2IUnkVZIZ2vdBplxUySIumS4H60O2yNiohg6QIxGGQNp3XAhVXQBaaL9qJ9yEpg5AXw1PtfYhaQJcbQ4dBWpW/FSDDKoh7QE+ZDBJKlMUgbYqEFiRRKJsKAmMEcukxCHFTn1VBIDgiEY8KEkrUtscgzQ0Lj7e84busQ+ARQU6lEUEiDFJXpv/LKn9q/R54NBAIJW4bMkhDe9EAAgkGOQQJDQQcWep2YpD2F1l7DIKfMyaZrUggqSy39XsMUtc5Knks4S7IQpU6BK5HAAFLfm7sW2ma9gwCydq1Fo27LLQ/QUOyCVx7sVh4rUDwk8Zd8PvJi4MIXKdtL3rSmmwtyKkva2MQTVeoA1ntuoDAybkwCL1lXAHBIh1A4HRjEHoR1IPAakYHwfkMQuwthyoIzu0EAuGWQUjl0AACSXDoAAJzh0Go86EHgcmIDoILxwzStgg0IHhIjnQQVOgwSJuuMWhBUMmIDoKbWzcG0bfMY4AmENTEntFBSvVCy3dQIXwL/eYbujrJrsPhHnC/Fv0F9XmJ7Y5QCXwL/ebCjxsGMb2/26MDGQAAAIBB/tb3+EohIQgRghAhCBGCECEIQYgQhAhBiBCECEEIQoQgRAhChCBECEKmhAhBiBCEIEQIQoQgRAhChCCEAH5cjemfuOxZAAAAAElFTkSuQmCC', 
            				width: 100,
            				height: 80
            			},
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				
            			},
            			]
            		},
            		{ text: 'VENTA', style: 'titulo' },
            		{
            			columns: [
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAAA1BMVEUAAACnej3aAAAAGElEQVR42u3BAQEAAACCoP6vdkjAAAA4EAn2AAHInXdYAAAAAElFTkSuQmCC', 
            				width: 60,
            				height: 3,
            			},
            			{
            				width: '*',
            				text: ''
            			},
            			]
            		},
            		'\n\n',
            		{
            			columns: [
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				width: '*',
            				text: [
            					'COD: ',
            					{text: <?php echo json_encode($egreso->venta)?>, bold: true, fontSize: 16}
            				],
            				style: 'derecha'
            			},
            			]
            		},
            		'\n\n',
            		{
            			columns: [
            			{
            				table: {
            					widths: [ 100, 'auto'],
            					body: [
            					    [ {text:'Fecha:', alignment:'right', bold:true}, <?php echo json_encode(date('d/m/Y H:i:s', strtotime($egreso->fecha_egreso)))?>],
            					    [ {text:'Nombre:', alignment:'right', bold:true}, <?php echo json_encode($soluser->nombre)?>],
            					    [ {text:'NIT/CI:', alignment:'right', bold:true}, <?php echo json_encode($soluser->ci)?>]
            					]
            				},
            				layout: 'noBorders',
            				margin: [5,0,0,0]
            				
            			},
            			
            			{
            				table: {
            					widths: [ 100, 'auto'],
            					body: [
                                    [ {text:'IMPORTE TOTAL: ', alignment:'right', bold:true}, <?php echo json_encode(money_format('%.2n', $egreso->total))?>+' Bs.'],
            						[ {text:'TOTAL EFECTIVO: ', alignment:'right', bold:true}, <?php echo json_encode(money_format('%.2n',$egreso->pagado))?>+' Bs.'],
            						[ {text:'CAMBIO: ', alignment:'right', bold:true}, <?php $total = json_encode($egreso->total); $pagado = json_encode($egreso->pagado); echo json_encode(money_format('%.2n',$pagado-$total));?>+' Bs.']
            					]
            				},
            				layout: 'noBorders',
            				margin: [5,0,0,0]
            			},
            			]
            		},
            		{ 
            			table: {
            					widths: [ 'auto', 'auto', 200, 'auto', 'auto', 50, 60],
            					body: [
            						[ {text:'No.', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9}, 
            						  {text:'Código', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9}, 
                                      {text:'Descripción', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 11},
            						  {text:'Unidad', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 11},
            						  {text:'Cantidad', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9},
            						  {text:'Precio', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9},
            						  {text:'Importe', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9}
            						],
                                    <?php $num = 1;foreach($detalles as $det){?>
            						[ {text: '<?php echo json_encode($num)?>', alignment:'center', fontSize: 10}, 
            						  {text: <?php echo json_encode($det->codigo)?>, alignment:'center', fontSize: 9}, 
            						  {text: <?php echo json_encode($det->descripcion)?>, alignment:'left', fontSize: 9},
            						  {text: <?php echo json_encode($det->unidad)?>, alignment:'left', fontSize: 9},
            						  {text: '<?php echo json_encode($det->cantidad)?>', alignment:'right', fontSize: 10},
                                      {text: <?php echo json_encode(money_format('%.2n',$det->costo_vendido))?>, alignment:'right', fontSize: 10},
                                      {text: <?php echo json_encode(money_format('%.2n',$det->costo_total))?>, alignment:'right', fontSize: 10}
            						],
            						<?php $num++;}?>
            					]
            				},
            				
            				margin: [20,0,20,0]
            		},
            		{text:'OBSERVACIONES:', bold:true, margin:[20,20,0,0]},
                    {text: <?php echo json_encode($egreso->observacion)?>, margin:[20,0,20,0], fontSize: 8, alignment: 'justify'},
                    { image: codigo, width:50, height: 50, margin: [0,40,0,0], alignment: 'right'}
            		
            	],
            
            	styles: {
            		titulo: {
            			bold: true,
            			fontSize: 18,
            			color: 'black',
            			alignment: 'center',
            			margin: [20,20,20,0]
            		},
            		justificado: {
            			alignment: 'justify',
            			margin: [20,0,20,0]
            		},
            		derecha: {
            			alignment: 'right',
            			margin: [0,0,40,0]
            		}
            	}
            };
        pdfMake.createPdf(soli).print();
    }
     function descarga(){
         var soli = {
            	pageSize: 'letter',
            	footer: function(page, pages) { 
            	    return { 
            	        columns: [ 
            	            { text:'Generado por Sistema Web de Administración de Minimarket', fontSize: 7},
            	            { 
            	                alignment: 'right',
            	                text: [
            	                    { text: page.toString(), italics: true },
            	                    ' de ',
            	                    { text: pages.toString(), italics: true }
            	                ],
            	                fontSize: 7
            	            }
            	        ],
            	        margin: [10, 0]
            	    };
            	},
            	content: [
            	    {
            			columns: [
            			{
            				image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAAFkCAMAAAA5Yp3xAAADAFBMVEUUrpqENlv/w1mU0sT/ukv/4rGyQl2gPlxkwY2o2cr/997iIUv/0nP/YVb/zW6qP2JBt5T/t0oxs5f/WVX/ubGMN1X/6ZR6M1nYLkj/yUb1QVH7S1J5M1b/wkndxM/g8uv/0YX//v2ZO1r/yke64sv/kYb/xkn/q5qENlX/4d7/U1P/yWcis5idPF3/253/vkf/d2ntN07/6uj/uUgArJv+UFKcPVmUOVjpMU3LdIr/3oaKQV5Mu5H/v1PcE0j/Zlj/t0qrQFr/vEn/24Hu5erP69qJN12WO1f/nJP/9+aPOV7/Ylf/2NO9a4ZUvZFYv4+8c4n/hYVHuZRfv42RWXfWp7WIN1fKh5j/vlCmPlv/w0htxJWjPV/3aXX/vUr/xUb/9fWVO13/XFZTu5B9NFrozdWlP1//ukt1MlX/xkX/ZFaGzaX/6MH/yUr/XlaPOVeBNVr4R1H/v0nD5dH/vk6kPWD/Zln/xGJepZ2OOFsdsZn/dEhgwI7wWmv/5Iv9eX2ON13QOkupPWHZuMX/hnr/wFXzP1CANFWZPF2YPlzn19/Y7+B9NFbr9vD/13n/ZFf/x0f/qWH/z4f/lYXsNE1iwIyqP11eqqTnLU11MVnRna3/aFj/+/RYvY+iPVnZipqLOVv/i1L/x8GUOF7/W1X/3IrpP1//eEr/aFT/yUifYH2Pho/PkqWhPl//ko//X1b/Z1rvPE+DzMH/uEf/1s3/uEv/ZVn/Zlj67vBLupLvOk7/eEr/xET/ZVxsnpr2+/iUOVz/w0SoQVj/uEj/vEmvQVz/vE7fGkk4tZabPFf/wUq2Q2Dm2uH/vkf/cUplv47/v1OMOF6eP1nAf5L/8NJTuZP/fkv3RFHPfZFNvJJ5O1ioQFyZOFzlKEz/Z1hyNVj/ZleR0a3/Z1ep3L+c1bR4yZ369vf/ZVj/yGD+TlP/VlP/xEn/ykv/u1b/vE/uSmSfVG+LNVz/YFT/Ylf/1olpwI1dwYr/Ylv/zET/Ylrx+fT/uUj/wEi/QVVRvZP///+veYK/AAABAHRSTlP///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8AU/cHJQAAI7pJREFUeAHs0TEBhEAMALC31f0sdP+lujCAADxgoG5ARG9gSCzk9/ApQoQgRAijEIQgRAhChCBECEKEIAQhQhAiBCFCECIEIQgRghAhCBGCECEIQYgQhAhBiBCECEEIQoQgRAhChCBECEIQIgQhQhAiBCH/yqNjos+sS8gWKzvuHaJzCZmql70yRm0cCKNwNy58AZMi4CM4ldUY5gBbi4F1ue5zgLAsCwvbG2G2UE6gwp1xKRhUpFPjhUHttnsCwf7z5gVPCm1kpZ2nyfv/efqTYj40ERrqhWLHyhZraAQeM7lPQD6Kw0vJE2loNxCiV4pIviQgU3XKM5LwrmgMwp499woT9ACBc4pjfa+y/JSATNJ9pvzpilkx9oN6+X9kleoXjWjeLbLvCcgE/cqsslZRNi7wWMOp5bL9YrPZCI/5vOuenhOQW7V8zpSlFEwFU2goZOxY4m2U9M2VR3f4u/2TgNzGI7eWZz9d5KHF+42omQsQwXFYr/dPpwTkRh7a6tobZINbLBFewEXYQwiwQmT5S9/Aowk8AGQ1lkgCAh48SYKAi4CIJ84UAdqas/F7ek8cuK/AY79fbU8JyGgecrza1mIRjykCqDp8H+SxFiCC47w6jyWSgOS6qOtaF846p3XhpbGCNB9ENhQ6YzwhcTGPOe4r8Dgff9yNIpKALPNP1slJigpjnHtd8iNCCQYhhUlhh5QzBXhE9xWuKwAZRSQBWf422gSVwWFYFOMy6mNjNvOb2ry5r/h9rI5Hz+Pusn1IQN79Pq5nv3Oh+M5HZen70ic7FIcJHzLAgj7zr5BH84bHmTwuj18fEpB3eJjWtM6Us5nhklYcBuEVyo4znGMNfbmbtWZWCY/mlcdBtCcP+Q8iQB4vl2EiCQh4CA45SnmuqirvrXgchqTiYJzDfsr7torvq0P3jz0z1m0bBsLw6KHI5CWwtttigEuA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', 
            				width: 100,
            				height: 80
            			},
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				
            			},
            			]
            		},
            		{ text: 'VENTA', style: 'titulo' },
            		{
            			columns: [
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAAA1BMVEUAAACnej3aAAAAGElEQVR42u3BAQEAAACCoP6vdkjAAAA4EAn2AAHInXdYAAAAAElFTkSuQmCC', 
            				width: 60,
            				height: 3,
            			},
            			{
            				width: '*',
            				text: ''
            			},
            			]
            		},
            		'\n\n',
            		{
            			columns: [
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				width: '*',
            				text: ''
            			},
            			{
            				width: '*',
            				text: [
            					'COD: ',
            					{text: <?php echo json_encode($egreso->venta)?>, bold: true, fontSize: 16}
            				],
            				style: 'derecha'
            			},
            			]
            		},
            		'\n\n',
            		{
            			columns: [
            			{
            				table: {
            					widths: [ 100, 'auto'],
            					body: [
            					    [ {text:'Fecha:', alignment:'right', bold:true}, <?php echo json_encode(date('d/m/Y H:i:s', strtotime($egreso->fecha_egreso)))?>],
            					    [ {text:'Nombre:', alignment:'right', bold:true}, <?php echo json_encode($soluser->nombre)?>],
            					    [ {text:'NIT/CI:', alignment:'right', bold:true}, <?php echo json_encode($soluser->ci)?>]
            					]
            				},
            				layout: 'noBorders',
            				margin: [5,0,0,0]
            				
            			},
            			
            			{
            				table: {
            					widths: [ 100, 'auto'],
            					body: [
                                    [ {text:'IMPORTE TOTAL: ', alignment:'right', bold:true}, <?php echo json_encode(money_format('%.2n', $egreso->total))?>+' Bs.'],
            						[ {text:'TOTAL EFECTIVO: ', alignment:'right', bold:true}, <?php echo json_encode(money_format('%.2n',$egreso->pagado))?>+' Bs.'],
            						[ {text:'CAMBIO: ', alignment:'right', bold:true}, <?php $total = json_encode($egreso->total); $pagado = json_encode($egreso->pagado); echo json_encode(money_format('%.2n',$pagado-$total));?>+' Bs.']
            					]
            				},
            				layout: 'noBorders',
            				margin: [5,0,0,0]
            			},
            			]
            		},
            		{ 
            			table: {
            					widths: [ 'auto', 'auto', 200, 'auto', 'auto', 50, 60],
            					body: [
            						[ {text:'No.', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9}, 
            						  {text:'Código', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9}, 
                                      {text:'Descripción', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 11},
            						  {text:'Unidad', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 11},
            						  {text:'Cantidad', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9},
            						  {text:'Precio', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9},
            						  {text:'Importe', alignment:'center', bold:true, fillColor:'#C2C2C2', fontSize: 9}
            						],
                                    <?php $num = 1;foreach($detalles as $det){?>
            						[ {text: '<?php echo json_encode($num)?>', alignment:'center', fontSize: 10}, 
            						  {text: <?php echo json_encode($det->codigo)?>, alignment:'center', fontSize: 9}, 
            						  {text: <?php echo json_encode($det->descripcion)?>, alignment:'left', fontSize: 9},
            						  {text: <?php echo json_encode($det->unidad)?>, alignment:'left', fontSize: 9},
            						  {text: '<?php echo json_encode($det->cantidad)?>', alignment:'right', fontSize: 10},
                                      {text: <?php echo json_encode(money_format('%.2n',$det->costo_vendido))?>, alignment:'right', fontSize: 10},
                                      {text: <?php echo json_encode(money_format('%.2n',$det->costo_total))?>, alignment:'right', fontSize: 10}
            						],
            						<?php $num++;}?>
            					]
            				},
            				
            				margin: [20,0,20,0]
            		},
            		{text:'OBSERVACIONES:', bold:true, margin:[20,20,0,0]},
                    {text: <?php echo json_encode($egreso->observacion)?>, margin:[20,0,20,0], fontSize: 8, alignment: 'justify'},
                    { image: codigo, width:50, height: 50, margin: [0,40,0,0], alignment: 'right'}
            		
            	],
            
            	styles: {
            		titulo: {
            			bold: true,
            			fontSize: 18,
            			color: 'black',
            			alignment: 'center',
            			margin: [20,20,20,0]
            		},
            		justificado: {
            			alignment: 'justify',
            			margin: [20,0,20,0]
            		},
            		derecha: {
            			alignment: 'right',
            			margin: [0,0,40,0]
            		}
            	}
            };
         pdfMake.createPdf(soli).download('venta_minimarket.pdf');
     }
    </script>
@stop
