let num = [3,8,4]
num[3]= 6
num.push(7)
console.log(num)
console.log(num.length)
console.log(num[0])
num.sort()
console.log(num)
/*for(let pos=0;pos<num.length;pos++){
    console.log(`A posição ${pos} tem o valor ${num[pos]}`)
}*/
for (let pos in num){
    console.log(`A posição ${pos} tem o valor ${num[pos]}`)
}
let pos = num.indexOf(2)
if (pos == -1){
    console.log('numero não encontrado')
} else {
    console.log(`o valor esta na posição ${pos}`)
}
