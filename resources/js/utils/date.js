export const formatDate = (date) => {
    return new Date(date).toLocaleDateString("pt-BR", {
        timeZone: "UTC",
    });
};

export const expireDate = (date, days) => {
    date.setDate(date.getDate() + days);
    return formatDate(date);
};
