arrayOfWords = [
    ["черный",  "black"],
    ["желтый",   "#BCAB00"],
    ["красный", "red"],
    ["синий",   "blue"],
    ["зеленый", "#22ff00"]
];

mainWord = document.getElementById("mainWord");
firstChoosenWords = document.getElementById("firstChooseWord");
secondChoosenWords = document.getElementById("secondChooseWord");
thirdChoosenWords = document.getElementById("thirdChooseWord");
objScore = document.getElementById("numScore");

score = 0;
colorArray = new Array();
countOfRightAnswers = 0;
//combo

time = 1000;
//t;
// function getRandomInRange(min, max) {
//     return Math.floor(Math.random() * (max - min + 1)) + min;
// }
// случайные числа
function severalRandom(min, max, num) {
    var i, arr = [], res = [];
    for (i = min; i <= max; i++ ) arr.push(i);
    for (i = 0; i < num; i++) res.push(arr.splice(Math.floor(Math.random() * (arr.length)), 1)[0])
    return res;
}

//array for color

function fillColorMatrix() {
    //формирование мест для выбора ответов
    colorArray[0] = severalRandom(1,3,3);
    //формирование цветов для выбора
    colorArray[1] = severalRandom(0,4,3);
}

function addMainWord2Words4Choosing() {
    for(let i = 0; i < 3; i++ ){
        if(colorArray[0][i] == 1){
            //берем индекс из случано сгенерированного массива цветов
            //индекс говорит на каком из трех мест для ответа будет один из ответов
            let indexOfColor = colorArray[1][i];
            firstChoosenWords.innerHTML = arrayOfWords[indexOfColor][0];
        }else if(colorArray [0][i] == 2){
            let indexOfColor = colorArray[1][i];
            secondChoosenWords.innerHTML = arrayOfWords[indexOfColor][0];
        }else{
            let indexOfColor = colorArray[1][i];
            thirdChoosenWords.innerHTML = arrayOfWords[indexOfColor][0];
        }
    }
}


//заполнение главного слова названием цвета и другим цветом шрифта
function fillMainWord() {
    let indColor = colorArray[1][0];
    mainWord.innerHTML = arrayOfWords[indColor][0];
    indColor = colorArray[1][1];
    mainWord.style.color = arrayOfWords[indColor][1];
}



function generateNewWords(){
    clearTimeout(t);
    fillColorMatrix();
    fillMainWord();
    addMainWord2Words4Choosing();

    t = setTimeout(function () {
        generateNewWords();
        if(score>5){
            score -= 5;
        }else{
            score = 0;
        }
        if(time < 5000){
            time += 500;
        }
        objScore.innerText = score;
    }, time);

}


function getColorByRusName(nameColor) {
    for(let i = 0; i < arrayOfWords.length; i++){
        if(arrayOfWords[i][0] == nameColor){
            return arrayOfWords[i][1];
        }
    }
}
function clickOnWord (numOfWord){
    clearTimeout(t);
    let colorMain = mainWord.style.color; // color of main word

    //get color of chosen word
    if(numOfWord == 1){
        var colorChosen = firstChoosenWords.innerHTML;
    }else if(numOfWord == 2){
        var colorChosen = secondChoosenWords.innerHTML;
    }else{
        var colorChosen = thirdChoosenWords.innerHTML;
    }

    colorChosen = getColorByRusName(colorChosen);

    if (colorMain == colorChosen){
        score += 5;
        countOfRightAnswers++;     //если правильные ответы идут подряд, комбо
        if(countOfRightAnswers == 3){ // при комбо х3 уменьшаем время для след. уровня
            countOfRightAnswers = 0;
            if(time > 1000){
                time -=1000;
            }
        }

    }else{
        countOfRightAnswers = 0; //если ответ неверный, то обнулаяем комбо и увеличиваем время для след. уровня
        if(time < 5000){
            time += 500;
        }
        if(score>5){
            score -= 5;
        }else{
            score = 0;
        }
    }
    objScore.innerText = score;

    generateNewWords();

    //получить цвет главного слова
    //получить значение выбранного слова
    //сравнить значение выбранного слова с главным
    //увеличить|уменьшить очки
    //ускорить|замедлить время
}

//запуск генерации нового слова при загрузке


function firstLaunch() {
    window.onload = function () {
        generateNewWords();
    };
//запуск таймера для загрузки нового слова спустя время некоторое
    t =   setTimeout(function () {
        generateNewWords();
    }, time);
}


