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
  const initiallyCheckedRadio = document.querySelector(
    "input[name=category]:checked"
  );

  // Nếu có 1 cái được chọn sẵn (như khi sửa sản phẩm)
  if (initiallyCheckedRadio) {
    // Thì mình "giả" 1 cú click để kích hoạt logic ẩn/hiện
    // Bằng cách tìm cái hàm ẩn/hiện và gọi nó
    // (Lưu ý: Code này chỉ hoạt động nếu bạn dùng file tôi gửi lần trước,
    // vì nó cần hàm "updateSizeBoxVisibility" đã được tạo)

    // Nếu bạn muốn an toàn, hãy cứ thay thế toàn bộ file
    // vì code mới của tôi có tổ chức lại 1 chút cho sạch.

    // Nếu bạn VẪN muốn tự thêm, thì bạn phải sửa code cũ
    // thành 1 hàm (như file tôi gửi), rồi gọi hàm đó ở đây:

    // updateSizeBoxVisibility(initiallyCheckedRadio.value);

    // *** CÁCH DỄ HƠN NHIỀU CHO BẠN: ***
    // Hãy kích hoạt "sự kiện" 1 cách thủ công
    initiallyCheckedRadio.dispatchEvent(new Event("change"));
  }
});
