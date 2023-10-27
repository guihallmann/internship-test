export const formatAddress = (person) => {
    const { street, number, complement, neighborhood, city } = person;
    return street
        ? `${street}, ${number ? number : "S/N"}${
              complement ? ` - ${complement}` : ""
          }${neighborhood ? ` - ${neighborhood},` : ""} ${city ? city : ""}`
        : "";
};
