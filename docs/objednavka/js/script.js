// Form transition
document.getElementById("order-form").style.transition = "padding-top 500ms ease-in-out";

// Steps
const step1 = document.querySelector('.step-content[data-step="1"]');
const step2 = document.querySelector('.step-content[data-step="2"]');
const step3 = document.querySelector('.step-content[data-step="3"]');
const step4 = document.querySelector('.step-content[data-step="4"]');
const step5 = document.querySelector('.step-content[data-step="5"]');
const step6 = document.querySelector('.step-content[data-step="6"]');

// Buttons
const btnForwardStep2 = document.querySelector('a.btn.btn-forward[data-set-step="2"]');
const btnForwardStep3 = document.querySelector('a.btn.btn-forward[data-set-step="3"]');
const btnForwardStep4 = document.querySelector('a.btn.btn-forward[data-set-step="4"]');
const btnForwardStep5 = document.querySelector('a.btn.btn-forward[data-set-step="5"]');
const btnPrevStep1 = document.querySelector('a.btn.btn-prev[data-set-step="1"]');
const btnPrevStep2 = document.querySelector('a.btn.btn-prev[data-set-step="2"]');
const btnPrevStep3 = document.querySelector('a.btn.btn-prev[data-set-step="3"]');
const btnPrevStep4 = document.querySelector('a.btn.btn-prev[data-set-step="4"]');
const submitOrder = document.querySelector("button.btn.btn-forward");

// Required inputs
const nameInput = document.getElementById("name");
const email = document.getElementById("email");
const tel = document.getElementById("tel");
const pevneDesky = document.getElementById("pevne-desky");
const krouzkoveVazby = document.getElementById("krouzkove-vazby");
const termin = document.getElementById("termin-zhotoveni");
const pocetListu = document.getElementById("pocet-listu");
const barvaDesek = document.getElementsByName("barva-desek");
const barvaPisma = document.getElementsByName("barva-pisma");
const kapsyCdDvd = document.getElementById("kapsy-cd-dvd");
const chlopneNaPrilohy = document.getElementById("chlopne-na-prilohy");
const souboryDesky = document.getElementById("soubory-desky");
const vytisknoutPraci = document.getElementById("vytisknout-praci");
const obchodniPodminky = document.getElementById("obchodni-podminky");

// Optional inputs
const listyNavic = document.getElementById("listy-navic");
const poznamka = document.getElementById("poznamka");

// Tisk práce
const typTisku = document.getElementsByName("typ-tisku");
const pocetVytisku = document.getElementById("pocet-vytisku");
const souboryTisk = document.getElementById("soubory-tisk");

// Form
const form = document.getElementById("order-form");

// Files
souboryDesky.onchange = function () {
    if (souboryDesky.files.length > 5) {
        alert("Můžete vložit maximálně 5 souborů");
    };

    let size = 0;

    Array.from(souboryDesky.files).forEach((file) => {
        let filesize = file.size;
        size += filesize;
    });

    let sizeInMB = ((size / 1024) / 1024).toFixed(4);

    if (sizeInMB > 10) {
        alert("Maximální velikost příloh může být 10 MB.");
    };
};

souboryTisk.onchange = function () {
    if (souboryTisk.files.length > 5) {
        alert("Můžete vložit maximálně 5 souborů");
    };

    let size = 0;

    Array.from(souboryTisk.files).forEach((file) => {
        let filesize = file.size;
        size += filesize;
    });

    let sizeInMB = ((size / 1024) / 1024).toFixed(4);

    if (sizeInMB > 10) {
        alert("Maximální velikost příloh může být 10 MB.");
    };
};

btnForwardStep2.onclick = function () {
    document.querySelectorAll("input#pevne-desky, input#krouzkove-vazby, input#termin-zhotoveni, select#pocet-listu").forEach((element) => {
        if (!element.value) {
            element.classList.add("invalid");
            alert("Musíte vyplnit všechna povinná pole! Povinná pole jsou označena červenou hvězdičkou.");
        };
    });

    if ((pevneDesky.value + krouzkoveVazby.value) == 0) {
        alert("Musíte zvolit alespoň jedno zhotovení pevných desek nebo jednu kroužkovou vazbu.")
    };

    if (pevneDesky.value == 0) {
        document.querySelectorAll("#black, #blue, #bordeaux, #gold, #silver").forEach((input) => {
            input.disabled = true;
        });
        document.getElementById("section-barva-desek").classList.add("disabled");
        document.getElementById("section-barva-pisma").classList.add("disabled");
    } else {
        document.querySelectorAll("#black, #blue, #bordeaux, #gold, #silver").forEach((input) => {
            input.disabled = false;
        });
        document.getElementById("section-barva-desek").className = "";
        document.getElementById("section-barva-pisma").className = "";
    };

    if ((pevneDesky.value + krouzkoveVazby.value) >= 1 && termin.value && pocetListu.selectedIndex !== 0) {
        step1.classList.remove("current");
        step1.classList.add("prev");
        step2.classList.remove("next");
        step2.classList.add("current");
        document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");
        window.scrollTo({ top: 0, behavior: "smooth" });
    };
};

btnForwardStep3.onclick = function () {
    document.querySelectorAll("select#kapsy-cd-dvd, select#chlopne-na-prilohy").forEach((element) => {
        if (!element.value) {
            element.classList.add("invalid");
        } else {
            element.className = "";
        };
    });

    if (souboryDesky.files.length === 0) {
        alert("Musíte přiložit alespoň jeden soubor!");
    };

    if (souboryDesky.files.length > 5) {
        alert("Můžete vložit maximálně 5 souborů");
    };

    let size = 0;

    Array.from(souboryDesky.files).forEach((file) => {
        let filesize = file.size;
        size += filesize;
    });

    let sizeInMB = ((size / 1024) / 1024).toFixed(4);

    if (sizeInMB > 10) {
        alert("Maximální velikost příloh může být 10 MB.");
    };

    if (!(vytisknoutPraci.checked) && kapsyCdDvd.selectedIndex !== 0 && chlopneNaPrilohy.selectedIndex !== 0 && souboryDesky.files.length !== 0 && souboryDesky.files.length <= 5 && sizeInMB < 10) {
        step3.className = "step-content next hidden";
        pocetVytisku.required = false;
        souboryTisk.required = false;
        step2.classList.remove("current");
        step2.classList.add("prev");
        step4.classList.remove("next");
        step4.classList.add("current");
        document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");
        window.scrollTo({ top: 0, behavior: "smooth" });
    } else if (vytisknoutPraci.checked && kapsyCdDvd.selectedIndex !== 0 && chlopneNaPrilohy.selectedIndex !== 0 && souboryDesky.files.length !== 0 && souboryDesky.files.length <= 5 && sizeInMB < 10) {
        pocetVytisku.required = true;
        souboryTisk.required = true;
        step2.classList.remove("current");
        step2.classList.add("prev");
        step3.classList.remove("hidden");
        step3.classList.remove("next");
        step3.classList.add("current");
        document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");
        window.scrollTo({ top: 0, behavior: "smooth" });
    };
};

btnForwardStep4.onclick = function () {
    if (souboryTisk.files.length === 0) {
        alert("Musíte přiložit alespoň jeden soubor!");
    };

    if (souboryTisk.files.length > 5) {
        alert("Můžete vložit maximálně 5 souborů");
    };

    let size = 0;

    Array.from(souboryDesky.files).forEach((file) => {
        let filesize = file.size;
        size += filesize;
    });

    let sizeInMB = ((size / 1024) / 1024).toFixed(4);

    if (sizeInMB > 10) {
        alert("Maximální velikost příloh může být 10 MB.");
    };

    if (souboryTisk.files.length !== 0 && souboryTisk.files.length <= 5 && sizeInMB < 10) {
        step3.classList.remove("current");
        step3.classList.add("prev");
        step4.classList.remove("next");
        step4.classList.add("current");
        document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");
        window.scrollTo({ top: 0, behavior: "smooth" });
    };
};

// Onclick events
btnForwardStep5.onclick = function () {
    document.querySelectorAll("input#name, input#email, input#tel").forEach((element) => {
        if (!element.value) {
            element.className = "invalid";
            alert("Musíte vyplnit všechna povinná pole! Povinná pole jsou označena červenou hvězdičkou.");
        } else {
            element.className = "valid";
        }
    });

    document.querySelectorAll("#name, #email, #tel, #pevne-desky, #krouzkove-vazby, #termin-zhotoveni, #kapsy-cd-dvd, #chlopne-na-prilohy").forEach((input) => {
        const id = input.getAttribute("id");
        const tableCol = document.querySelector('td[data-input="' + id + '"]');
        tableCol.innerHTML = input.value;
    });

    let pocetListuShownValue = "";
    switch (pocetListu.value) {
        case "1":
            pocetListuShownValue = "20 - 40 listů";
            break;
        case "2":
            pocetListuShownValue = "41 - 90 listů";
            break;
        case "3":
            pocetListuShownValue = "91 - 120 listů";
            break;
        case "4":
            pocetListuShownValue = "121 - 145 listů";
            break;
        case "5":
            pocetListuShownValue = "146 - 185 listů";
            break;
        case "6":
            pocetListuShownValue = "186 - 230 listů";
            break;
        case "7":
            pocetListuShownValue = "231 - 265 listů";
            break;
        case "8":
            pocetListuShownValue = "266 - 300 listů";
            break;
    };
    document.querySelector('td[data-input="pocet-listu"]').innerHTML = pocetListuShownValue;

    for (const barvaDesekSelected of barvaDesek) {
        if (barvaDesekSelected.checked) {
            document.querySelector('td[data-input="barva-desek"]').innerHTML = barvaDesekSelected.value;
        };
    };

    for (const barvaPismaSelected of barvaPisma) {
        if (barvaPismaSelected.checked) {
            document.querySelector('td[data-input="barva-pisma"]').innerHTML = barvaPismaSelected.value;
        };
    };

    if (listyNavic.checked) {
        document.querySelector('td[data-input="listy-navic"]').innerHTML = "ANO";
    } else {
        document.querySelector('td[data-input="listy-navic"]').innerHTML = "NE";
    };

    if (poznamka.value) {
        document.querySelector('td[data-input="poznamka"]').innerHTML = poznamka.value;
    } else {
        document.querySelector('td[data-input="poznamka"]').innerHTML = "Žádná";
    };

    if (souboryDesky.files.length !== 0) {
        document.querySelector('td[data-input="soubory-desky"]').innerHTML = '';
        Array.from(souboryDesky.files).forEach((file) => {
            const newElement = document.createElement("p");
            newElement.innerHTML = file.name;
            document.querySelector('td[data-input="soubory-desky"]').appendChild((newElement));
        });
    };

    if (vytisknoutPraci.checked && pocetVytisku.value && souboryTisk.files.length !== 0) {
        document.getElementById("soubory-tisk-row").style.display = "table-row";
        document.getElementById("pocet-vytisku-row").style.display = "table-row";
        document.querySelector('td[data-input="pocet-vytisku"]').innerHTML = pocetVytisku.value;
        document.querySelector('td[data-input="soubory-tisk"]').innerHTML = '';
        Array.from(souboryTisk.files).forEach((file) => {
            const newElement = document.createElement("p");
            newElement.innerHTML = file.name;
            document.querySelector('td[data-input="soubory-tisk"]').appendChild((newElement));
        });
    } else {
        document.getElementById("soubory-tisk-row").style.display = "none";
        document.getElementById("pocet-vytisku-row").style.display = "none";
    }

    for (const typTiskuSelected of typTisku) {
        if (typTiskuSelected.checked) {
            document.getElementById("typ-tisku-row").style.display = "table-row";
            document.querySelector('td[data-input="typ-tisku"]').innerHTML = typTiskuSelected.value;
        };
    }

    if (nameInput.value && email.value && tel.value) {
        step4.classList.remove("current");
        step4.classList.add("prev");
        step5.classList.remove("next");
        step5.classList.add("current");
        document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");
        window.scrollTo({ top: 0, behavior: "smooth" });
    };
};

submitOrder.onclick = (button) => {
    button.preventDefault();
    if (obchodniPodminky.checked) {
        form.submit();
    };
};

btnPrevStep1.onclick = function () {
    step2.classList.remove("current");
    step2.classList.add("next");
    step1.classList.remove("prev");
    step1.classList.add("current");
    document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");
    window.scrollTo({ top: 0, behavior: "smooth" });
};

btnPrevStep2.onclick = function () {
    step3.classList.remove("current");
    step3.classList.add("next");
    step2.classList.remove("prev");
    step2.classList.add("current");
    document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");
    window.scrollTo({ top: 0, behavior: "smooth" });
};

btnPrevStep3.onclick = function () {
    if (vytisknoutPraci.checked) {
        step4.classList.remove("current");
        step4.classList.add("next");
        step3.classList.remove("prev");
        step3.classList.add("current");
    } else if (!(vytisknoutPraci.checked)) {
        step4.classList.remove("current");
        step4.classList.add("next");
        step2.classList.remove("prev");
        step2.classList.add("current");
    }
    document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");
    window.scrollTo({ top: 0, behavior: "smooth" });
};

btnPrevStep4.onclick = function () {
    step5.classList.remove("current");
    step5.classList.add("next");
    step4.classList.remove("prev");
    step4.classList.add("current");
    document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");
    window.scrollTo({ top: 0, behavior: "smooth" });
};

// Link: https://codepen.io/erevan/pen/geGjzx

//----------------------------------------//
//  GLOBAL VARS
//----------------------------------------//

// Lower track color
var rangeSliderTrackColor = '#cdcdcd',
    // Upper track color
    rangeSliderTrackFillColor = '#ef7c00',

    // ID of the HTML style element that gets appended to the HTML head
    rangeSliderStyleElementID = 'rangeSliderStyleElement',

    // Class that gets assigned to the individual range sliders (+ ongoing index number)
    rangeSliderClass = 'range-slider__input--',

    // A variable to call every instance of range sliders
    $rangeSliderElement = document.querySelectorAll('.range-slider input[type=range]'),

    // A variable to call every instance of dotted range sliders
    $dottedRangeSliderElement = document.querySelectorAll('.range-slider--dotted input[type=range]');

//----------------------------------------//
//  FUNCTIONS
//----------------------------------------//

// Function to create empty style elements in the HTML head 
// to append the dynamic syles for the range sliders to
function createStyleElements(numberOfStyleElements) {
    // We want a <style> element
    var rangeSliderStyleElement = document.createElement('style');
    // ...equal the amount of range sliders on the side
    rangeSliderStyleElement.id = rangeSliderStyleElementID + numberOfStyleElements;
    // ...and append it to the HTML head
    document.head.appendChild(rangeSliderStyleElement);
}

// Function that takes care of coloring the range slider track differently
// on the left and on the right side of the slider handle.
function paintRangeTrack(rangeSliderInstance) {
    // Get the current value of the actual range slider
    var rangeValue = $rangeSliderElement[rangeSliderInstance].value,
        // Get the min and max attributes value of the actual range slider
        rangeMinValue = $rangeSliderElement[rangeSliderInstance].getAttribute('min'),
        rangeMaxValue = $rangeSliderElement[rangeSliderInstance].getAttribute('max');

    // Generate the CSS and put it into the style tag with the appropriate ID in the HTML head
    // (One for Webkit, one for Firefox)    
    document.getElementById(rangeSliderStyleElementID + rangeSliderInstance).textContent =
        'input[class~="' + rangeSliderClass + rangeSliderInstance + '"]::-webkit-slider-runnable-track{background: linear-gradient(90deg, ' + rangeSliderTrackFillColor + ' ' + Math.round(((rangeValue - rangeMinValue) / (rangeMaxValue - rangeMinValue)) * 100) + '% , ' + rangeSliderTrackColor + ' ' + Math.round(((rangeValue - rangeMinValue) / (rangeMaxValue - rangeMinValue)) * 100 + 1) + '%)}' +
        'input[class~="' + rangeSliderClass + rangeSliderInstance + '"]::-moz-range-track{background: linear-gradient(90deg, ' + rangeSliderTrackFillColor + ' ' + Math.round(((rangeValue - rangeMinValue) / (rangeMaxValue - rangeMinValue)) * 100) + '% , ' + rangeSliderTrackColor + ' ' + Math.round(((rangeValue - rangeMinValue) / (rangeMaxValue - rangeMinValue)) * 100 + 1) + '%)}';
}



// Function to generate the correct amount dots for dotted range sliders
function createRangeSliderDots(dottedRangeSliderInstance) {
    // Get the min value of the actual range slider
    var rangeSliderMinValue = $dottedRangeSliderElement[dottedRangeSliderInstance].getAttribute('min'),
        // Get the max value of the actual range slider
        rangeSliderMaxValue = $dottedRangeSliderElement[dottedRangeSliderInstance].getAttribute('max'),
        // Calculate the correct number of steps thereof
        rangeSliderDots = rangeSliderMaxValue - rangeSliderMinValue + 1,
        // Get the container to put the dot elements into
        $rangeSliderStepsContainer = document.querySelectorAll('.range-slider__dots');

    // Iterate over the amount of the actual needed dots
    for (var i = 0; i < rangeSliderDots; i++) {
        // We want to create span elements representing the dots
        var rangeSliderDotElement = document.createElement('span');

        // Append the span to the dots container
        $rangeSliderStepsContainer[dottedRangeSliderInstance].appendChild(rangeSliderDotElement);
    }
}



// Function to generate the necessary container for the dots of the dotted range slider
function createDotsContainerElement() {

    // For every dotted range slider...    
    Array.prototype.forEach.call(document.querySelectorAll('.range-slider--dotted'), function (el, i) {
        // ...we want a <div> element
        var dotsContainerElement = document.createElement('div');

        // ...with a class of 'range-slider__dots`
        dotsContainerElement.className = 'range-slider__dots';

        // ...and append it to the actual range slider
        el.appendChild(dotsContainerElement);
    });

}



// Function to paint the slider dots in the correct color
function paintSliderDots(dottedRangeSliderInstance) {
    // Get the current value of the actual range slider    
    var rangeSliderValue = $dottedRangeSliderElement[dottedRangeSliderInstance].value,
        // Collect all dots from the actual dotted slider
        rangeSliderDots = $dottedRangeSliderElement[dottedRangeSliderInstance].parentNode.querySelectorAll('.range-slider__dots span');

    // Iterate over all dots of this respective dotted range slider
    for (var j = 0; j < rangeSliderDots.length; j++) {
        // If the dot is lower than the sliders current value...
        if (j < rangeSliderValue) {
            // ...paint it in the lower slider tracks color
            rangeSliderDots[j].style.backgroundColor = rangeSliderTrackFillColor;
            // If it's greater than the current sliders value...
        } else {
            // ...paint it in the upper slider tracks color
            rangeSliderDots[j].style.backgroundColor = rangeSliderTrackColor;
        }
    }
}

//----------------------------------------//
//  DOM-READY FUNCTION
//----------------------------------------//

document.addEventListener('DOMContentLoaded', function (event) {
    // NORMAL RANGE SLIDERS    

    // Get all range sliders on the page
    var sliders = $rangeSliderElement;

    // Iterate over all range sliders on the page
    for (var rangeSliders = 0; rangeSliders < sliders.length; rangeSliders++) {
        // Create an empty style element for each range slider 
        // in the hmtl head and give each one an unique id.
        createStyleElements(rangeSliders);

        // Give each range slider an unique class
        $rangeSliderElement[rangeSliders].classList.add(rangeSliderClass + rangeSliders);

        // Fill the lower and upper end of the range slider track with the correct color
        paintRangeTrack(rangeSliders);

        // On-change function, so the filled area 
        // changes dynamically with the current sliders value   
        sliders[rangeSliders].addEventListener('input', function () {
            // Iterate over all range sliders on the page
            for (var i = 0; i < sliders.length; i++) {
                // Fill the lower and upper end of the range slider track with the correct color
                paintRangeTrack(i);
            }
        })
    }

    // DOTTED RANGE SLIDERS    

    // Get all dotted range sliders on the page
    var dottedSliders = $dottedRangeSliderElement;

    // Create the dots container element
    createDotsContainerElement();

    // Iterate over all range sliders on the page
    for (var dottedRangeSliders = 0; dottedRangeSliders < dottedSliders.length; dottedRangeSliders++) {

        // Create the dots
        createRangeSliderDots(dottedRangeSliders);

        // ...and paint them appropriately
        paintSliderDots(dottedRangeSliders);

        // Add event listener (when the user changes the value)
        dottedSliders[dottedRangeSliders].addEventListener('input', function () {
            // Iterate over all range dotted sliders on the page
            for (var i = 0; i < dottedSliders.length; i++) {
                // ...and paint them correctly on change
                paintSliderDots(i);
            }
        })

        // Add an additional event listener ('mousemove') for IE
        // (IE seems to have a problem with the 'input' event listeners on range sliders)
        dottedSliders[dottedRangeSliders].addEventListener('mousemove', function () {
            // Iterate over all range dotted sliders on the page
            for (var i = 0; i < dottedSliders.length; i++) {
                // ...and paint them correctly on change
                paintSliderDots(i);
            };
        });
    };
});

// Show value of 'pevne-desky', 'krouzkove-vazby', 'kapsy-cd-dvd' and 'chlopne-na-prilohy'
document.querySelectorAll("input#pevne-desky, input#krouzkove-vazby, input#kapsy-cd-dvd, input#chlopne-na-prilohy, input#pocet-vytisku").forEach((input) => {
    const name = input.name;
    const displayValueElement = document.getElementById("value-of-" + name);
    let value = input.value;

    if (displayValueElement) {
        displayValueElement.innerHTML = "<h4>" + value + "</h4>";

        input.oninput = function () {
            value = input.value
            displayValueElement.innerHTML = "<h4>" + value + "</h4>";
        };
    };
});

// Show value of 'pocet-listu'
function showValueOfPocetListu() {
    const input = document.getElementById("pocet-listu");
    const displayValueElement = document.getElementById("value-of-pocet-listu");
    let value = input.value;
    let firstLine = "";
    let secondLine = "";

    if (displayValueElement) {
        switch (value) {
            case "1":
                firstLine = "20 - 40 listů";
                secondLine = "5 mm (AA)";
                break;
            case "2":
                firstLine = "41 - 90 listů";
                secondLine = "10 mm (A)";
                break;
            case "3":
                firstLine = "91 - 120 listů";
                secondLine = "13 mm (B)";
                break;
            case "4":
                firstLine = "121 - 145 listů";
                secondLine = "16 mm (C)";
                break;
            case "5":
                firstLine = "146 - 185 listů";
                secondLine = "20 mm (D)";
                break;
            case "6":
                firstLine = "186 - 230 listů";
                secondLine = "24 mm (E)";
                break;
            case "7":
                firstLine = "231 - 265 listů";
                secondLine = "28 mm (F)";
                break;
            case "8":
                firstLine = "266 - 300 listů";
                secondLine = "32 mm (G)";
                break;
        };
        displayValueElement.innerHTML = "<h4>" + firstLine + "</h4><p>" + secondLine + "</p>";

        input.oninput = function () {
            value = input.value;
            switch (value) {
                case "1":
                    firstLine = "20 - 40 listů";
                    secondLine = "5 mm (AA)";
                    break;
                case "2":
                    firstLine = "41 - 90 listů";
                    secondLine = "10 mm (A)";
                    break;
                case "3":
                    firstLine = "91 - 120 listů";
                    secondLine = "13 mm (B)";
                    break;
                case "4":
                    firstLine = "121 - 145 listů";
                    secondLine = "16 mm (C)";
                    break;
                case "5":
                    firstLine = "146 - 185 listů";
                    secondLine = "20 mm (D)";
                    break;
                case "6":
                    firstLine = "186 - 230 listů";
                    secondLine = "24 mm (E)";
                    break;
                case "7":
                    firstLine = "231 - 265 listů";
                    secondLine = "28 mm (F)";
                    break;
                case "8":
                    firstLine = "266 - 300 listů";
                    secondLine = "32 mm (G)";
                    break;
            };
            displayValueElement.innerHTML = "<h4>" + firstLine + "</h4><p>" + secondLine + "</p>";
        };
    };
};
showValueOfPocetListu();

// Height of fieldset
document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");