function getProfile(search = '') {
  $.ajax({
    url: 'SearchProfiles.php',
    method: 'post',
    data: {
      search: search,
    },
    success: function (data) {
      $('#searchOutput').html(data)
    },
  })
}

// add delay to search to prevent multi network requests
function debounce(cb, delay = 500) {
  let timeout

  return (...args) => {
    if (timeout) clearTimeout(timeout)

    timeout = setTimeout(() => {
      cb(...args)
    }, delay)
  }
}

const searchProfile = debounce((searchTerm) => {
  getProfile(searchTerm)
})

$(document).ready(function () {
  getProfile()
  $('#searchCustomerProfile').keyup(function (e) {
    searchProfile(e.target.value)
  })
})
