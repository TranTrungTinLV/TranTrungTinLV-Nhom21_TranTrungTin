function getBotResponse(input) {
    //chơi oẳn tù tì
    if (input == "búa") {
        return "bao";
    } else if (input == "bao") {
        return "kéo";
    } else if (input == "kéo") {
        return "búa";
    }

    // Simple responses
    if (input == "hi") {
        return "Xin chào!";
    } else if (input == "tạm biệt") {
        return "Hẹn gặp lại bạn lần sau 😄";
    } else {
        return "Thử hỏi điều gì khác";
    }
}