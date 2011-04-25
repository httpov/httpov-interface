<table id="jobTable" class="tablesorter">
  <thead>
  <tr>
    <th>prio</th>
    <th>name</th>
    <th>issued</th>
    <th>duration [sec]</th>
  </tr>
  </thead>
  <tbody>
{section name=id loop=$results}
  <tr>
    <td align="right">{$results[id]->prio}</td>
    <td align="right">{$results[id]->name}</td>
    <td align="right">{$results[id]->issued}</td>
    <td align="right">{$results[id]->time}</td>
  </tr>
{sectionelse}
  <tr><td colspan=13>no matching jobs found.</td></tr>
{/section}
  </tbody>
</table>
