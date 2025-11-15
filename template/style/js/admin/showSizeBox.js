//PHAN CHIA THIEN HA
document.addEventListener("DOMContentLoaded", () => {
  //lay querry
  const categoryID = document.querySelectorAll("input[name=category]");

  const sizeBlocks = document.querySelectorAll(".size-block");

  //chay su kien duyet tung cai radio
  categoryID.forEach((radio) => {
    //su kien change
    radio.addEventListener("change", () => {
      //lay id cua cai radio da duoc chon
      const selectCateID = radio.value;

      // An tat ca text box
      sizeBlocks.forEach((block) => {
        block.style.display = "none";

        //lay may cai the textarea thuoc thang sizeBlock
        const textarea = block.querySelector("textarea");
        //neu cai the textarea ton tai thi vo hieu hoa no
        if (textarea) {
          textarea.disabled = true;
        }
      });
      // =======================================================================================

      //tao cai bien de lay ra cac text box can duoc xuat hien
      let sizeNeed = null;
      if (selectCateID == "2") {
        sizeNeed = document.querySelector('.size-block[data-category-id="2"]');
      } else if (selectCateID == "7") {
        sizeNeed = document.querySelector('.size-block[data-category-id="7"]');
      } else {
        sizeNeed = document.querySelector(
          '.size-block[data-category-id="default"]'
        );
      }

      // neu cai text box do ton tai thi xuat hien
      if (sizeNeed) {
        sizeNeed.style.display = "block";
        const inputToShow = sizeNeed.querySelector("textarea");
        if (inputToShow) {
          inputToShow.disabled = false;
        }
      }
    });
  });

  //tim radio da duoc check theo id
});
