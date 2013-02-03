
function ucfirst(string)
{
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function makeArray(hash)
{
  var list = [];

  for (var n in hash)
  {
    list.push(hash[n]);
  }

  return list;
}

function inArray(needle, stack)
{
  for (var n = 0; n < stack.length; n++)
  {
    if (stack[n] === needle)
    {
      return true;
    }
  }

  return false;
}

function intval(value)
{
  if (typeof value === "string")
  {
    return parseInt(value, 10);
  }

  return value;
}

function sortTimestamp(a, b)
{
  var aDate = new Date(intval(a.timestamp));
  var bDate = new Date(intval(b.timestamp));

  return bDate.getTime() - aDate.getTime();
}

function sortTimestampReverse(a, b)
{
  var aDate = new Date(intval(a.timestamp));
  var bDate = new Date(intval(b.timestamp));

  return aDate.getTime() - bDate.getTime();
}

function sortDate(a, b)
{
  var aDate = new Date(a.date);
  var bDate = new Date(b.date);

  return aDate.getTime() - bDate.getTime();
}

function sortName(a, b)
{
  if (a.name < b.name)
  {
    return -1;
  }

  if (a.name > b.name)
  {
    return 1;
  }

  return 0;
}
