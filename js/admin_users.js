const editButtons = document.querySelectorAll(".edit-btn");

function changeCellToInput(cell, type) {
  const value = cell.textContent.trim();
  const input = document.createElement("input");

  input.type = type;
  input.value = value;
  input.className = "table-input";

  cell.textContent = "";
  cell.appendChild(input);
}

editButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    const row = button.closest("tr");
    const form = button.closest(".edit-form");
    const idCell = row.querySelector(".user-id");
    const nameCell = row.querySelector(".user-name");
    const emailCell = row.querySelector(".user-email");

    if (button.textContent === "수정") {
      changeCellToInput(idCell, "text");
      changeCellToInput(nameCell, "text");
      changeCellToInput(emailCell, "email");

      button.textContent = "확인";
      return;
    }

    const userId = idCell.querySelector("input").value.trim();
    const userName = nameCell.querySelector("input").value.trim();
    const userEmail = emailCell.querySelector("input").value.trim();

    if (userId === "") {
      alert("아이디를 입력하세요.");
      return;
    }

    if (userName === "") {
      alert("이름을 입력하세요.");
      return;
    }

    if (userEmail === "") {
      alert("이메일을 입력하세요.");
      return;
    }

    form.querySelector("input[name='userId']").value = userId;
    form.querySelector("input[name='userName']").value = userName;
    form.querySelector("input[name='userEmail']").value = userEmail;
    form.submit();
  });
});
