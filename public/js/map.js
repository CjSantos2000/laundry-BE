function initMap() {
    const map = L.map('map').setView([14.61873, 121.15204], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
  
    // Add a marker for your shop
    const shopMarker = L.marker([14.61873, 121.15204]).addTo(map);
    shopMarker.bindPopup("You").openPopup();
  
    // (Optional) Add markers for other shops (replace with your data)
    const shops = [
      { lat: 14.62054, lng: 121.14926, title: "Shop 2" },
      { lat:14.61142, lng: 121.15811, title: "Shop 3" },
    ];
  
    for (const shop of shops) {
      const marker = L.marker([shop.lat, shop.lng]).addTo(map);
      marker.bindPopup(shop.title);
    }




    // // Function to create shop markers (assuming data comes from $shop_admins)
    // function createShopMarker(shop) {  // Use 'shop' as the parameter name
    //   const shopImage = `url({{ asset('storage/' . shop.image) }})`; // Assuming 'image' property exists

    //   const markerContent = `
    //     <div class="custom-marker">
    //       <img src="${shopImage}" alt="Shop Image" width="100" height="100">
    //       <p class="shop-name">${shop.name}</p>
    //       <p class="shop-address">${shop.address.substring(0, 30)}...</p>
    //     </div>
    //   `;

    //   const customMarker = L.marker([shop.lat, shop.lng]).bindPopup(markerContent);
    //   return customMarker;
    // }


    //   $shop_admins.forEach(shopadmin => {
    //     const shop = {
    //       lat: shopadmin.latitude, // Assuming 'latitude' property exists
    //       lng: shopadmin.longitude, // Assuming 'longitude' property exists
    //       title: shopadmin.shop_name,  // Assuming 'shop_name' property exists
    //       // Add other shop properties as needed (e.g., image)
    //     };
    //     shops.push(shop);
    //   });

    //   // Add markers for shops using the 'shops' array
    //   for (const shop of shops) {
    //     const marker = createShopMarker(shop); // Call the createShopMarker function, passing the shop object
    //     marker.addTo(map);
    //   }
    
}
    // Call the initialization function after the DOM is loaded
    window.onload = initMap;
