<table id="trackTable" class="tablesorter">
  <thead>
  <tr>
    <th>last contact [sec]</th>
    <th>ip</th>
    <th>ver</th>
    <th>cmd</th>
    <th>client</th>
  </tr>
  </thead>
  <tbody>
{section name=id loop=$results}
  <tr>
    <td align="right">{$results[id]->time}</td>
    <td align="right">{$results[id]->ip}</td>
    <td align="right">{$results[id]->ver}</td>
    <td align="right">{$results[id]->cmd}</td>
    <td align="right">{$results[id]->client}</td>
  </tr>
{sectionelse}
  <tr><td colspan=5>no matching rendering clients found.</td></tr>
{/section}
  </tbody>
</table>
