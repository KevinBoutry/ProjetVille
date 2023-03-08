"use strict";

const inpImage = document.querySelector("#image");
const preview = document.querySelector("#preview img");

inpImage.addEventListener("change", loadImage)

function loadImage()
{    
    const [file] = inpImage.files;
    if(file)
    {
        preview.src = URL.createObjectURL(file)
    }
}