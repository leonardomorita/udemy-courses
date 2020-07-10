module.exports.getDate = getDate;
function getDate() {
    const today = new Date();

    const options = {
        weekday: "long",
        day: "numeric",
        month: "long"
    };
    
    // Retorna o dia em um formato específico
    return today.toLocaleDateString("en-US", options);
}

module.exports.getDay = function () {
    const today = new Date();

    const options = {
        weekday: "long"
    };
    
    // Retorna o dia em um formato específico
    return today.toLocaleDateString("en-US", options);
};
