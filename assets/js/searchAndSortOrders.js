function getOrders(option) {
  $.ajax({
    url: 'SearchOrders.php',
    method: 'post',
    data: {
      search: option.search ? option.search : null,
      allOrders: option.allOrders ? option.allOrders : null,
      inprocess: option.inprocess ? option.inprocess : null,
      completed: option.completed ? option.completed : null,
    },
    success: function (data) {
      $('#searchAndSortOutput').html(data)
    },
  })
}

function debounce(cb, delay = 500) {
  let timeout

  return (...args) => {
    if (timeout) clearTimeout(timeout)

    timeout = setTimeout(() => {
      cb(...args)
    }, delay)
  }
}

const SearchOrders = debounce((searchTerm) => {
  getOrders(searchTerm)
})

$(document).ready(function () {
  //checkbox
  const allOrders = $('#formCheck-1').is(':checked')
  const inprocess = $('#formCheck-2').is(':checked')
  const completed = $('#formCheck-3').is(':checked')
  getOrders({
    search: null,
    allOrders: allOrders ? allOrders : null,
    completed: completed ? completed : null,
    inprocess: inprocess ? inprocess : null,
  })

  $('#searchOrder').keyup(function (e) {
    const allOrders = $('#formCheck-1').is(':checked')
    const inprocess = $('#formCheck-2').is(':checked')
    const completed = $('#formCheck-3').is(':checked')
    SearchOrders({
      search: e.target.value,
      allOrders: allOrders ? allOrders : null,
      completed: completed ? completed : null,
      inprocess: inprocess ? inprocess : null,
    })
  })

  $('#formCheck-1').change(function (e) {
    const allOrders = $('#formCheck-1').is(':checked')
    const inprocess = $('#formCheck-2').is(':checked')
    const completed = $('#formCheck-3').is(':checked')
    if ($(this).is(':checked')) {
      return getOrders({
        search: null,
        allOrders: allOrders ? allOrders : null,
        completed: completed ? completed : null,
        inprocess: inprocess ? inprocess : null,
      })
    }
    getOrders({
      search: null,
      allOrders: allOrders ? allOrders : null,
      completed: completed ? completed : null,
      inprocess: inprocess ? inprocess : null,
    })
  })

  $('#formCheck-2').change(function (e) {
    const allOrders = $('#formCheck-1').is(':checked')
    const inprocess = $('#formCheck-2').is(':checked')
    const completed = $('#formCheck-3').is(':checked')
    if ($(this).is(':checked')) {
      return getOrders({
        search: null,
        allOrders: allOrders ? allOrders : null,
        completed: completed ? completed : null,
        inprocess: inprocess ? inprocess : null,
      })
    }
    getOrders({
      search: null,
      allOrders: allOrders ? allOrders : null,
      completed: completed ? completed : null,
      inprocess: inprocess ? inprocess : null,
    })
  })

  $('#formCheck-3').change(function (e) {
    const allOrders = $('#formCheck-1').is(':checked')
    const inprocess = $('#formCheck-2').is(':checked')
    const completed = $('#formCheck-3').is(':checked')
    if ($(this).is(':checked')) {
      return getOrders({
        search: null,
        allOrders: allOrders ? allOrders : null,
        completed: completed ? completed : null,
        inprocess: inprocess ? inprocess : null,
      })
    }
    getOrders({
      search: null,
      allOrders: allOrders ? allOrders : null,
      completed: completed ? completed : null,
      inprocess: inprocess ? inprocess : null,
    })
  })
})
