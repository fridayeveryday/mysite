var images = [                      // массив картинок
    "../images/gallery/img1.jpg",
    "../images/gallery/img2.jpg",
    "../images/gallery/img3.jpg",
    "../images/gallery/img4.jpg",
    "../images/gallery/img5.jpg"
];

var ind=0;
var num = 0;
var textNum = "";

/**
 * Функция для перелистывания вперёд
 */
function next(){
    document.getElementById("slider").classList.add("fadeOutRight");
    setTimeout(function () {
        ind++;
        if(ind >= images.length){
            ind = 0;
        }
        textNum = "";
        num = ind + 1;
        doDarkerMini(num);
        var id = 'p'+num;
        document.getElementById("slider").classList.remove("fadeOutRight");
        textNum += num + "/" + images.length;

        slider.src = images[ind];document.getElementById("slider").classList.add("fadeInLeft");
        document.getElementById("index").innerHTML = textNum;
        setTimeout(function () {
            document.getElementById("slider").classList.remove("fadeInLeft");
        },1000);
    },1000);

}

/**
 * Функция для перелистывания назад
 */
function  prev() {
    document.getElementById("slider").classList.add("fadeOutLeft");
    ind--;
    setTimeout(function () {
        if (ind < 0) {
            ind = images.length - 1;
        }
        textNum = "";
        num = ind + 1;
        doDarkerMini(num);
        var id = 'p'+num;
        document.getElementById("slider").classList.remove("fadeOutLeft");
        textNum += num + "/" + images.length;
        slider.src = images[ind];
        document.getElementById("slider").classList.add("fadeInRight");
        document.getElementById("index").innerHTML = textNum;
        setTimeout(function () {
            document.getElementById("slider").classList.remove("fadeInRight");
        },1000);
    }, 1000);

}

/**
 * Функция для открытия полноразмерной картинки из миниатюр
 * @param number - номер выбранной картинки
 */
function openPictureMini(number) {
    document.getElementById("slider").classList.add("flipOutX");                //добавление эфеекта угасания и поворота по Ох через стидль css
    ind = number - 1;                                                              //инлекс в массиве картинок
    setTimeout(function () {                                           // пауза на срабатывание эффекта
        textNum = "";                                                          //строка для вставки надписи (номер текущей / все)
        doDarkerMini(number);
        document.getElementById("slider").classList.remove("flipOutX"); // удалить класс turnUpDown для приведения названия класса в первоначлаьный вид, для дальнейших переходов
        textNum += number + "/" + images.length;                                         // надпись номер текущей картинки из всех
        document.getElementById("slider").classList.add("flipInX");        //добавление класса turnDownUp для эффекта появления картинки
        slider.src = images[ind];                                                     //добавление картинки
        document.getElementById("index").innerHTML = textNum;                 //вставка надписи номера картинки
        setTimeout(function () {
            document.getElementById("slider").classList.remove("flipInX");
        },1000);
    }, 1000);
}
window.onload=doDarkerMini(1); //затемнение для первой при загрузке страницы

/**
 * Функция для затемнения миниматюр
 * @param number - номер выбранной миниатюры
 */
function doDarkerMini(number) {
    var idChosenPicture = 'p' + number;
    for(let i = 1; i <= 5;  i++){
        let idAllMiniPicture = 'p'+i;
        document.getElementById(idAllMiniPicture).style.filter = "brightness(100%)";
    }
    document.getElementById(idChosenPicture).style.filter = "brightness(40%)";
}