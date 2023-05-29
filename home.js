


  function scrollSection(direction) {
    var section = document.getElementById('section2');
    var scrollAmount = 500; // Quantità di scorrimento in pixel
    
    if (direction === 'left') {
      section.scrollLeft -= scrollAmount;
    } else if (direction === 'right') {
      section.scrollLeft += scrollAmount;
    }
  }

  


