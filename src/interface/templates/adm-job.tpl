<table id="jobTable" class="tablesorter">
  <thead>
  <tr>
    <th>id</th>
    <th>prio</th>
    <th>name</th>
    <th>frames</th>
    <th>rows</th>
    <th>sliced</th>
    <th>count</th>
    <th>current</th>
    <th>slice</th>
    <th>issued</th>
    <th>duration [sec]</th>
  </tr>
  </thead>
  <tbody>
{section name=id loop=$results}
  <tr>
    <td align="right">{$results[id]->id}</td>
    <td align="right">{$results[id]->prio}</td>
    <td align="right">{$results[id]->name}</td>
    <td align="right">{$results[id]->frames}</td>
    <td align="right">{$results[id]->rows}</td>
    <td align="right">{$results[id]->sliced}</td>
    <td align="right">{$results[id]->count}</td>
    <td align="right">{$results[id]->current}</td>
    <td align="right">{$results[id]->slice}</td>
    <td align="right">{$results[id]->issued}</td>
    <td align="right">{$results[id]->time}</td>
  </tr>
{sectionelse}
  <tr><td colspan=13>no matching jobs found.</td></tr>
{/section}
  </tbody>
</table>
