function verificar(){
    //window.alert('funcionou')
    var data = new Date()
    var ano = data.getFullYear()
    var fano = document.getElementById('txtano')
    var res = document.querySelector('div#res')
    var genero = ''
    var img = document.createElement('img')
    img.setAttribute('id','foto')
    if (fano.value.length == 0 || fano.value > ano){
        //window.alert('[ERRO] dados incorretos')
    } else {
        //window.alert('tudo ok')
        var fsex  = document.getElementsByName('radsex')
        var idade = ano - Number(fano.value)
        //res.innerHTML = `idade calculada de ${idade} anos` 
        if (fsex[0].checked){
            genero = 'Homem'
            if (idade >=0 && idade <10){
                //criança
                img.setAttribute('src','fcrianca-m.png')
            } else if (idade <21){
                //jovem
                img.setAttribute('src','fjovem-m.png')
            } else if (idade <60){
                //adulto
                img.setAttribute('src','fadulto-m.png')
            } else {
                //idoso
                img.setAttribute('src','fidoso-m.png')
            }
        } else if (fsex[1].checked) {
            genero = 'Mulher'
            if (idade >=0 && idade <10){
                //criança
                img.setAttribute('src','fcrianca-f.png')
            } else if (idade <21){
                //jovem
                img.setAttribute('src','fjovem-f.png')
            } else if (idade <60){
                //adulto
                img.setAttribute('src','fadulto-f.png')
            } else {
                //idoso
                img.setAttribute('src','fidoso-f.png')
            }
        }
        res.style.textAlign = 'center'
        res.innerHTML = `Detectamos ${genero} com ${idade} anos`
        res.appendChild(img)
    }
}